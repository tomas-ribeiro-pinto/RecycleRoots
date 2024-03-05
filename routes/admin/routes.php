<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    'hasTeam',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/recycle-centres', function () {
        return view('recycle-points-menu');
    })->name('recycle-centres');
});