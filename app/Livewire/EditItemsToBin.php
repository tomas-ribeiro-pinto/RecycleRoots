<?php

namespace App\Livewire;

use App\Models\BinException;
use App\Models\BinLocation;
use App\Models\Item;
use App\Models\TeamPostcode;
use Livewire\Component;

class EditItemsToBin extends Component
{
    public $postcode;
    public $selectedBin;
    public $filter;
    public $search;
    public $items;
    public $selectedBinItems;
    public $selectedItem;
    public $highlightIndex;
    public $filterEmpty;
    public $searchEmpty;
    public $binExceptions;

    protected $listeners = ['addBin'];

    public function mount($selectedBin, $postcode)
    {
        $this->postcode = $postcode;
        $this->selectedBin = $selectedBin;
        $this->selectedBinItems = $this->selectedBin->getItems();
        $this->getExceptions();
        $this->clearFilter();
        $this->clearSearch();
    }

    public function render()
    {
        return view('livewire.edit-items-to-bin');
    }

    public function updatedFilter()
    {
        if($this->filter == '')
        {
            $this->clearFilter();
            return;
        }
        $this->filterEmpty = false;
        $this->selectedBinItems = array_filter($this->selectedBinItems, function($item) {
            return str_contains(strtoupper($item['item']['name']), strtoupper($this->filter));
        });
    }

    public function clearFilter()
    {
        $this->filterEmpty = true;
        $this->filter = '';
        $this->getBinItemsWithExceptions();
    }

    public function updatedSearch()
    {
        if($this->search == '')
        {
            $this->clearSearch();
            return;
        }
        $this->searchEmpty = false;
        $this->selectedItem = -1;
        $this->items = Item::where('name', 'like', '%'.$this->search.'%')
            ->take(6)
            ->get()
            ->toArray();
    }

    public function clearSearch()
    {
        $this->searchEmpty = true;
        $this->search = '';
        $this->highlightIndex = 0;
        $this->items = [];
        $this->selectedItem = -1;
    }

    public function selectItem($id)
    {
        $item = Item::find($id);
        $this->items = [];
        $this->selectedItem = $id;
        $this->search = $item->name;
    }

    public function incrementHighlight()
    {
        if($this->highlightIndex === count($this->items) - 1)
        {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if($this->highlightIndex === 0)
        {
            $this->highlightIndex = count($this->items) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectItemFromList()
    {
        $this->selectItem($this->items[$this->highlightIndex]['id']);
    }

    public function addItem()
    {
        if($this->selectedItem == -1)
        {
            return;
        }

        // Check if the item is already in the bin
        $filtered = array_filter($this->selectedBinItems, function($item) {
            return $item['item']['id'] == $this->selectedItem;
        });

        // If the item is already in the bin, don't add it again
        if(count($filtered) == 1)
        {
            $this->clearSearch();
            session()->flash('error', "Item already added!");
            return;
        }

        $this->binExceptions[] = [
            'bin_location_id' => $this->selectedBin->bin->id,
            'item_id' => $this->selectedItem,
            'exception_rule' => 'add'
        ];

        $this->clearSearch();
        $this->clearFilter();

        session()->flash('message', "Item Added!");
    }

    public function removeItem($id)
    {
        $item = $this->selectedBinItems[$id];
        $t_item = [
            'bin_location_id' => $this->selectedBin->bin->id,
            'item_id' => $id,
            'exception_rule' => $item['exception']
        ];

        if ($item['exception'] != null) {
            $this->binExceptions = array_filter($this->binExceptions, function($exception) use ($t_item) {
                return $exception != $t_item;
            });
            $this->clearFilter();
            session()->flash('message', "Item Added!");
        }
        else
        {
            $t_item['exception_rule'] = 'remove';
            $this->binExceptions[] = $t_item;
            $this->clearFilter();
            session()->flash('message', "Item Removed!");
        }
    }

    public function addBin()
    {
        // Check if the postcode and bin are selected
        if ($this->postcode == null || $this->selectedBin == null)
        {
            return back()->with('error', 'No postcodes or bin selected!');
        }

        // Remove any previous exceptions
        BinException::where('bin_location_id', $this->selectedBin->id)->delete();

        // Update the bin location with the new exceptions
        foreach($this->binExceptions as $exception)
        {
            $exception = new BinException(
                [
                    'bin_location_id' => $this->selectedBin->id,
                    'item_id' => $exception['item_id'],
                    'exception_rule' => $exception['exception_rule']
                ]
            );
            $exception->save();
        }
        return redirect(route('bin-rules').'/'.$this->postcode->postcode)->with('message', 'Bin Rule Edited!');
    }

    public function getBinItemsWithExceptions()
    {
        $binItems = $this->selectedBin->bin->items->sortBy('name');
        $binItemsWithExceptions = [];
        foreach($binItems as $item)
        {
            $binItemsWithExceptions[$item->id] = [
                'item' => $item,
                'exception' => null
            ];
        }
        if($this->binExceptions != null)
        {
            foreach($this->binExceptions as $exception)
            {
                $binItemsWithExceptions[$exception['item_id']] = [
                    'item' => Item::find($exception['item_id']),
                    'exception' => $exception['exception_rule']
                ];
            }
        }
        $this->selectedBinItems = $binItemsWithExceptions;
    }

    public function getExceptions()
    {
        $exceptions = $this->selectedBin->exceptions ?? [];
        foreach ($exceptions as $exception)
        {
            $this->binExceptions[] = [
                'bin_location_id' => $this->selectedBin->bin->id,
                'item_id' => $exception->item_id,
                'exception_rule' => $exception->exception_rule
            ];
        }
    }
}
