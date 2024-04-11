<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Post::all()->sortByDesc('updated_at');

        return view('blog', compact('articles'));
    }

    public function show($slug)
    {
        $article = Post::where('slug', $slug)->first();

        return view('article', compact('article'));
    }
}
