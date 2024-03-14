<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\BinLocation;
use App\Models\TeamPostcode;
use http\Client\Request;

class BinLocationController extends Controller
{
    public function index()
    {
        return view('bin-rules-menu');
    }

    public function show($postcode)
    {
        $postcode = TeamPostcode::where('postcode', $postcode)->where('team_id', auth()->user()->currentTeam->id)->first();
        $binLocations = $postcode->binLocations;

        return view('postcode-bin-rules-menu', compact('postcode', 'binLocations'));
    }

    public function create()
    {
        $postcode = [];

        if(request('postcode'))
        {
            $postcode = TeamPostcode::where('postcode', request('postcode'))->first();
            return view('bin-rules-add-menu', compact('postcode'));
        }

        return view('bin-rules-add-menu', compact('postcode'));
    }

    public function update($binLocation)
    {
        $binLocation = BinLocation::find($binLocation);
        $team = $binLocation->teamPostcode->team_id;

        if($team != auth()->user()->currentTeam->id)
        {
            abort(403);
        }

        return view('bin-rules-edit-menu', compact('binLocation'));
    }

    public function destroy()
    {
        $binLocation = BinLocation::find(request('id'));
        $binLocation->delete();

        return back()->with('message', 'Bin location removed');
    }
}
