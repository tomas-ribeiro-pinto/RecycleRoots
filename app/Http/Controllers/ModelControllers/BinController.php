<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\TeamPostcode;

class BinController extends Controller
{
    public function index()
    {
        return view('add-bin-menu');
    }
}
