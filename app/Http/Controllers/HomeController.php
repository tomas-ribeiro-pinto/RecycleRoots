<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     *  Show the application Home Page.
     * @return View
     */
    public function index() : View
    {
        $articles = Post::all()->sortByDesc('updated_at')->take(3);

        return view('home', compact('articles'));
    }
}
