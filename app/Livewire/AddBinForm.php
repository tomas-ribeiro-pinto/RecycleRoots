<?php

namespace App\Livewire;

use App\Models\Bin;
use App\Models\Item;
use Livewire\Component;

class AddBinForm extends Component
{
    public $model;
    public $filter;
    public $search;
    public $items;
    public $modelItems;
    public $originalModelItems;
    public $selectedItem;
    public $highlightIndex;
    public $filterEmpty;
    public $searchEmpty;

    //Form Variables
    public $name;
    public $color;
    public $dimensions;
    public $is_recycle_bin;
    public function mount()
    {
        $this->color = 'blue';
        $this->is_recycle_bin = 1;
        $this->clearFilter();
        $this->clearSearch();
        $this->model = new Bin();
        $this->modelItems = collect();
    }

    public function render()
    {
        return view('livewire.add-bin-form');
    }

    public function updatedFilter()
    {
        if($this->filter == '')
        {
            $this->clearFilter();
            return;
        }
        $this->filterEmpty = false;
        $this->modelItems = $this->modelItems->filter(function($modelItem) {
            return str_contains(strtoupper($modelItem->name), strtoupper($this->filter));
        });
    }

    public function clearFilter()
    {
        $this->filterEmpty = true;
        $this->filter = '';
        if($this->originalModelItems != null)
        {
            $this->modelItems = $this->originalModelItems->sortBy('name');
        }
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
        $item = Item::find($this->selectedItem);
        if($this->selectedItem == -1)
        {
            return;
        }
        if($this->modelItems->contains($item))
        {
            $this->clearSearch();
            session()->flash('error', "Item already added!");
            return;
        }

        $this->modelItems->push(Item::find($this->selectedItem));
        $this->originalModelItems = $this->modelItems;
        $this->clearSearch();
        session()->flash('message', "Item Added!");
    }

    public function removeItem($id)
    {
        $this->modelItems = $this->modelItems->where('id', '!=', $id)->sortBy('name');
        $this->originalModelItems = $this->modelItems;
        session()->flash('message', "Item Removed!");
    }

    public function addBin()
    {
        $this->clearFilter();
        if($this->canSubmit())
        {
            $this->model->save();
            foreach ($this->modelItems as $modelItem)
            {
                $this->model->items()->attach($modelItem->id);
            }
            session()->flash('message', "Bin Added!");

            return redirect(route('bin-rules') . '/add');
        }

        return back();
    }

    public function canSubmit()
    {
        if($this->name == null || $this->name == '')
        {
            session()->flash('error', "Name is required!");
            return false;
        }
        if($this->color == null || $this->color == '')
        {
            session()->flash('error', "Color is required!");
            return false;
        }
        if($this->dimensions == null || $this->dimensions == '')
        {
            session()->flash('error', "Dimensions are required!");
            return false;
        }

        $this->model->name = $this->name;
        $this->model->color = $this->color;
        $this->model->dimensions = $this->dimensions;
        $this->model->is_recycle_bin = $this->is_recycle_bin;
        $this->model->is_template = true;
        $this->model->team_id = auth()->user()->currentTeam->id;

        return true;
    }
}
