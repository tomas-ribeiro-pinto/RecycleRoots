<?php

namespace App\Http\Controllers\ModelControllers;

use App\Http\Controllers\Controller;
use App\Models\Charity;

class CharityController extends Controller
{
    public function index()
    {
        return view('charity-menu');
    }

    public function show(Charity $charity)
    {
        return view('charity-edit-menu', compact("charity"));
    }

    public function create()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'max:100'],
            'description' => ['max:200'],
            'charity_registration' => ['required', 'max:50'],
            'website' => ['required', 'url'],
        ]);

        $charity = Charity::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'description' => request('description'),
            'charity_registration' => request('charity_registration'),
            'website' => request('website')
        ]);

        $charity->save();

        return back()->with('message', 'Record Added!');
    }

    public function update()
    {
        if(!request('id'))
        {
            return back()->with('error', 'No Record Selected!');
        }

        $charity = Charity::find(request('id'));
        $attributes = request()->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'max:100'],
            'description' => ['max:200'],
            'charity_registration' => ['required', 'max:50'],
            'website' => ['required', 'url'],
        ]);

        $charity->update($attributes);

        return back()->with('message', 'Record Modified!');
    }

    public function destroy(): \Illuminate\Http\RedirectResponse
    {
        if(!request('id'))
        {
            return back()->with('error', 'No Record Selected!');
        }

        $charity = Charity::find(request('id'));
        $charity->items()->detach();
        $charity->delete();

        return redirect('charities')->with('message', 'Record Removed!');
    }
}
