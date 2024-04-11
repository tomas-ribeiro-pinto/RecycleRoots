<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class AddCategoryToPost extends Component
{
    public $post;
    public $categories;
    public $selectedCategory;
    public $search;
    // Selected Categories
    public $modelItems;

    public $selectedItem;
    public $highlightIndex;
    public $searchEmpty;

    public function mount($post)
    {
        $this->modelItems = collect();

        // If post is not null, get the post and add the categories to the modelItems
        if ($post != null) {
            $post = Post::find($post);
            foreach ($post->categories as $category) {
                $this->modelItems->push($category);
            }
        }

        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.add-category-to-post');
    }

    public function addItem()
    {
        $item = Category::find($this->selectedCategory);
        if($item == null)
        {
            return;
        }
        if($this->modelItems->contains($item))
        {
            $this->selectedCategory = '';
            session()->flash('error', "Item already added!");
            return;
        }

        $this->modelItems->push($item);
        $this->selectedCategory = '';
    }

    public function removeItem($id)
    {
        $this->modelItems = $this->modelItems->where('id', '!=', $id)->sortBy('name');
    }
}
