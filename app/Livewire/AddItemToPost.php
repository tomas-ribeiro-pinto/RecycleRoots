<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Post;
use Livewire\Component;

class AddItemToPost extends Component
{
    public $post;
    public $search;
    public $items;
    public $modelItems;

    public $selectedItem;
    public $highlightIndex;
    public $searchEmpty;

    public function mount($post)
    {
        $this->modelItems = collect();

        // If post is not null, get the post and add the items to the modelItems
        if ($post != null) {
            $post = Post::find($post);
            foreach ($post->items as $item) {
                $this->modelItems->push($item);
            }
        }

        $this->clearSearch();
    }

    public function render()
    {
        return view('livewire.add-item-to-post');
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

        $this->modelItems->push($item);
        $this->clearSearch();
    }

    public function removeItem($id)
    {
        $this->modelItems = $this->modelItems->where('id', '!=', $id)->sortBy('name');
    }
}
