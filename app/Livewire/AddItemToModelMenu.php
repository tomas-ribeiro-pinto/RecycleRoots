<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class AddItemToModelMenu extends Component
{
    public $model;
    public $filter;
    public $search;
    public $items;
    public $modelItems;
    public $selectedItem;
    public $highlightIndex;
    public $filterEmpty;
    public $searchEmpty;
    public $label;
    public function mount($model, $label)
    {
        $this->clearFilter();
        $this->clearSearch();
        $this->model = $model;
        $this->modelItems = $this->model->items->sortBy('name');
        $this->label = $label;
    }

    public function render()
    {
        return view('livewire.add-item-to-model-menu');
    }

    public function updatedFilter()
    {
        if($this->filter == '')
        {
            $this->clearFilter();
            return;
        }
        $this->filterEmpty = false;
        $this->modelItems = $this->model->items()
            ->where('name', 'like', '%'.$this->filter.'%')
            ->get()
            ->sortBy('name');
    }

    public function clearFilter()
    {
        $this->filterEmpty = true;
        $this->filter = '';
        $this->modelItems = $this->model->items->sortBy('name');
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
        if($this->model->items()->find($this->selectedItem) != null)
        {
            $this->clearSearch();
            session()->flash('error', "Item already added!");
            return;
        }
        $this->model->items()->attach($this->selectedItem);
        $this->modelItems = $this->model->items->sortBy('name');
        $this->clearSearch();
        session()->flash('message', "Item Added!");
    }

    public function removeItem($id)
    {
        $this->model->items()->detach($id);
        $this->modelItems = $this->model->items->sortBy('name');
        session()->flash('message', "Item Removed!");
    }
}
