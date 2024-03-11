<?php

use App\Http\Controllers\ModelControllers\CharityController;
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
    Route::get('/recycle-centres/{recycleCentre}', [RecyclePointController::class, 'show']);
    Route::post('/recycle-centres/{recycleCentre}/edit', [RecyclePointController::class, 'update']);
    Route::post('/recycle-centres/{recycleCentre}/remove', [RecyclePointController::class, 'destroy']);

    Route::get('/charities', [CharityController::class, 'index'])->name('charities');
    Route::post('/charities/add', [CharityController::class, 'create']);
    Route::get('/charities/{charity}', [CharityController::class, 'show']);
    Route::post('/charities/{charity}/edit', [CharityController::class, 'update']);
    Route::post('/charities/{charity}/remove', [CharityController::class, 'destroy']);
});