<?php

namespace App\Livewire;

use App\Http\Controllers\AdminBlogController;
use App\Models\Post;
use Livewire\Component;

class EditPostActionButtons extends Component
{
    public $slug;
    public $is_published;

    public function render()
    {
        return view('livewire.edit-post-action-buttons');
    }

    // Delete a Blog Article
    public function delete()
    {
        $post = Post::where('slug', $this->slug)->first();

        if($post == null)
        {
            return view('blog-menu')->with('message', 'Article not found!');
        }

        $post->delete();

        return redirect()->to(route('edit-blog'))->with('message', 'Article Deleted!');
    }

    // Unpublish a Blog Article
    public function unpublish()
    {
        $post = Post::where('slug', $this->slug)->first();

        if($post == null)
        {
            return view('blog-menu')->with('message', 'Article not found!');
        }

        $post->is_published = !$post->is_published;
        $post->save();

        //session()->flash('message', 'Article visibility changed!');
        $this->is_published = $post->is_published;
    }
}
