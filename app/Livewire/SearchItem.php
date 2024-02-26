<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class SearchItem extends Component
{

    public $query;
    public $items;
    public $selectedItem;
    public $highlightIndex;

    public function mount()
    {
        $this->resetQuery();
    }
    public function resetQuery()
    {
        $this->highlightIndex = 0;
        $this->query = '';
        $this->items = [];
        $this->selectedItem = -1;
    }
    public function render()
    {
        return view('livewire.search-item');
    }

    public function updatedQuery()
    {
        if($this->query == '')
        {
            $this->resetQuery();
            return;
        }
        $this->selectedItem = -1;
        $this->items = Item::where('name', 'like', '%'.$this->query.'%')
            ->take(5)
            ->get()
            ->toArray();
    }

    public function selectItem($id)
    {
        $item = Item::find($id);
        $this->items = [];
        $this->selectedItem = $id;
        $this->query = $item->name;
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
}
