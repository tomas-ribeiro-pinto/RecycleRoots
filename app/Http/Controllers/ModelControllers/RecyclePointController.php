<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\RecyclePoint;
use Illuminate\Support\ViewErrorBag;

class RecyclePointController extends Controller
{
    public function index()
    {
        return view('recycle-points-menu');
    }

    public function create()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:100'],
            'address' => ['required', 'max:100'],
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'managed_by' => ['required', 'max:100'],
            'description' => ['max:100'],
            'website' => ['required', 'url'],
        ]);

        $recyclePoint = RecyclePoint::create([
            'name' => request('name'),
            'address' => request('address'),
            'lat' => request('lat'),
            'lng' => request('lng'),
            'managed_by' => request('managed_by'),
            'description' => request('description'),
            'website' => request('website'),
            'team_id' => auth()->user()->currentTeam->id,
        ]);

        $recyclePoint->save();

        return back()->with('message', 'Record Added!');
    }

    public function show(RecyclePoint $recycleCentre)
    {
        $team = $recycleCentre->team_id;
        if($team != auth()->user()->currentTeam->id)
        {
            abort(403);
        }

        return view('recycle-points-edit-menu', compact("recycleCentre"));
    }

    public function update()
    {
        if(!request('id'))
        {
            return back()->with('error', 'No Record Selected!');
        }

        $recyclePoint = RecyclePoint::find(request('id'));
        $attributes = request()->validate([
            'name' => ['required', 'max:100'],
            'address' => ['required', 'max:100'],
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'managed_by' => ['required', 'max:100'],
            'description' => ['max:100'],
            'website' => ['required', 'url'],
        ]);

        $recyclePoint->update($attributes);

        return back()->with('message', 'Record Modified!');
    }

    public function destroy(): \Illuminate\Http\RedirectResponse
    {
        if(!request('id'))
        {
            return back()->with('error', 'No Record Selected!');
        }

        $recyclePoint = RecyclePoint::find(request('id'));
        $recyclePoint->delete();

        return redirect('recycle-centres')->with('message', 'Record Removed!');
    }
}
