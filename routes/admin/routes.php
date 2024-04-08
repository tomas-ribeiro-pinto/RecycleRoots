<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\ModelControllers\BinController;
use App\Http\Controllers\ModelControllers\BinLocationController;
use App\Http\Controllers\ModelControllers\CharityController;
use App\Http\Controllers\ModelControllers\RecyclePointController;
use Illuminate\Support\Facades\Route;

// Routes for basic admin role (e.g. blog editor)
Route::middleware([
    'auth:sanctum',
    'hasTeam',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/edit-blog', [AdminBlogController::class, 'index'])
        ->name('edit-blog');

    Route::get('/edit-blog/add', [AdminBlogController::class, 'create'])
        ->name('edit-blog.add');

    Route::get('/edit-blog/edit', [AdminBlogController::class, 'edit'])
        ->name('edit-blog.edit');
});

// Routes for Full Admin Role
Route::middleware([
    'auth:sanctum',
    'hasTeam',
    'hasAdminRole',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/recycle-centres', [RecyclePointController::class, 'index'])->name('recycle-centres');
    Route::post('/recycle-centres/add', [RecyclePointController::class, 'create']);
    Route::get('/recycle-centres/{recycleCentre}', [RecyclePointController::class, 'show']);
    Route::post('/recycle-centres/{recycleCentre}/edit', [RecyclePointController::class, 'update']);
    Route::post('/recycle-centres/{recycleCentre}/remove', [RecyclePointController::class, 'destroy']);

    Route::get('/bin-rules', [BinLocationController::class, 'index'])->name('bin-rules');
    Route::get('/bin-rules/create-template', [BinController::class, 'index'])->name('create-bin-template');
    Route::get('/bin-rules/add', [BinLocationController::class, 'create']);
    Route::get('/bin-rules/edit/{binLocation}', [BinLocationController::class, 'update']);
    Route::get('/bin-rules/{teamPostcode}', [BinLocationController::class, 'show']);
    Route::post('/bin-rules/{teamPostcode}/remove', [BinLocationController::class, 'destroy']);

    Route::get('/charities', [CharityController::class, 'index'])->name('charities');
    Route::post('/charities/add', [CharityController::class, 'create']);
    Route::get('/charities/{charity}', [CharityController::class, 'show']);
    Route::post('/charities/{charity}/edit', [CharityController::class, 'update']);
    Route::post('/charities/{charity}/remove', [CharityController::class, 'destroy']);
});