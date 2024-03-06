<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class CharityEditForm extends Component
{
    public $charity;
    public $filter;
    public $search;
    public $items;
    public $charityItems;
    public $selectedItem;
    public $highlightIndex;
    public $filterEmpty;
    public $searchEmpty;

    public function mount($charity)
    {
        $this->clearFilter();
        $this->clearSearch();
        $this->charity = $charity;
        $this->charityItems = $charity->items;
    }

    public function render()
    {
        return view('livewire.charity-edit-form');
    }

    public function updatedFilter()
    {
        if($this->filter == '')
        {
            $this->clearFilter();
            return;
        }
        $this->filterEmpty = false;
        $this->charityItems = $this->charity->items()
            ->where('name', 'like', '%'.$this->filter.'%')
            ->get();
    }

    public function clearFilter()
    {
        $this->filterEmpty = true;
        $this->filter = '';
        $this->charityItems = $this->charity->items;
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
        $this->charity->items()->attach($this->selectedItem);
        $this->charityItems = $this->charity->items;
        $this->clearSearch();
    }

    public function removeCharityItem($id)
    {
        $this->charity->items()->detach($id);
        $this->charityItems = $this->charity->items;
    }
}
