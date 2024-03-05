<?php

use App\Http\Controllers\ModelControllers\RecyclePointController;
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

    Route::get('/recycle-centres', [RecyclePointController::class, 'index'])->name('recycle-centres');
    Route::post('/recycle-centres/add', [RecyclePointController::class, 'create']);
    Route::post('/recycle-centres/edit', [RecyclePointController::class, 'update']);
    Route::post('/recycle-centres/remove', [RecyclePointController::class, 'destroy']);
});