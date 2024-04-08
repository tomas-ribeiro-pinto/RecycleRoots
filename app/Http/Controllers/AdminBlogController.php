<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
    public function store()
    {
        //return view('blog-menu');
    }

    // Returns view to edit a Blog Article
    public function edit()
    {
        return view('blog-edit-menu');
    }

    // Returns view to persist changes made to a Blog Article
    public function update()
    {
        //return view('blog-menu');
    }
}
