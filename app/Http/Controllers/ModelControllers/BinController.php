<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;

class BinController extends Controller
{
    public function index()
    {
        return view('bin-rules-menu');
    }

    public function indexAdd()
    {
        return view('bin-rules-add-menu');
    }

    public function create()
    {
        return redirect(route('bin-rules'))->with('message', 'Record Added!');
    }
}
