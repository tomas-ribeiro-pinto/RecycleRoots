<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Nette\Utils\Image;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view('blog-menu');
    }

    // Returns view to create a new Blog Article
    public function create()
    {
        return view('blog-add-menu');
    }

    // Persist the new Blog Article
    public function store(Request $request)
    {
        request()->validate([
            'title' => ['required', 'max:200'],
            'upload' => ['mimes:jpg,jpeg,png,gif', 'max:2048'],
            'body' => ['required'],
        ]);

        $thumbnail = null;

        if ($request->hasFile('upload')) {
            $image = $request->file('upload');

            $fileName = Storage::disk('public')->put('thumbnails'.'/', $image, 'public');
            $thumbnail = '/storage/' . $fileName;
        }

        $slug = Str::slug($request->title);

        if (Post::all()->where('slug' , Str::slug($request->title))->isNotEmpty()) {
            $slug .= '-' . Str::random(5);
            while(Post::all()->where('slug' , $slug)->isNotEmpty())
            {
                $slug .= '-' . Str::random(5);
            }
        }

        $post = Post::create([
            'title' => request('title'),
            'slug' => $slug,
            'body' => request('body'),
            'thumbnail_path' => $thumbnail ?? '/images/thumbnail.jpg',
            'user_id' => auth()->user()->id,
        ]);

        $post->save();

        if (request('categories')) {
            $categories = explode(",", request('categories'));
            foreach ($categories as $category) {
                $post->categories()->attach($category);
            }
        }

        if (request('items')) {
            $items = explode(",", request('items'));
            foreach ($items as $item) {
                $post->items()->attach($item);
            }
        }

        return view('blog-menu')->with('message', 'Article Added!');
    }

    // Returns view to edit a Blog Article
    public function edit($post)
    {
        $post = Post::where('slug', $post)->first();

        if ($post == null)
            abort(404);


        return view('blog-edit-menu', ['post' => $post]);
    }

    // Returns view to persist changes made to a Blog Article
    public function update(Request $request)
    {
        $post = Post::where('slug', request('slug'))->first();

        if($post == null)
        {
            return view('blog-menu')->with('message', 'Article not found!');
        }

        request()->validate([
            'title' => ['required', 'max:200'],
            'upload' => ['mimes:jpg,jpeg,png,gif', 'max:2048'],
            'body' => ['required'],
        ]);

        $thumbnail = $post->thumbnail_path;

        if ($request->hasFile('upload')) {
            $image = $request->file('upload');

            $fileName = Storage::disk('public')->put('thumbnails'.'/', $image, 'public');
            $thumbnail = '/storage/' . $fileName;
        }

        $post->update([
            'title' => request('title'),
            'body' => request('body'),
            'thumbnail_path' => $thumbnail ?? '/images/thumbnail.jpg',
        ]);

        if (request('categories')) {
            $categories = explode(",", request('categories'));
            $post->categories()->sync($categories);
        }
        else
        {
            $post->categories()->detach();
        }

        if (request('items')) {
            $items = explode(",", request('items'));
            $post->items()->sync($items);
        }
        else
        {
            $post->items()->detach();
        }

        return view('blog-menu')->with('message', 'Article Edited!');
    }
}
