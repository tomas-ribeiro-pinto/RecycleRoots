<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchResultController extends Controller
{
    /**
     *  Validate Post Request and
     *  Show the search results page.
     * @return View
     */
    public function index(Request $request) : View
    {
        $request->validate([
            'search' => 'required',
            'postcode' => 'required'
        ]);

        return view('search-result', [
            'search' => $request->input('search'),
            'postcode' => $request->input('postcode')
        ]);
    }
}
