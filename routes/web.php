<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchResultController;
use Illuminate\Support\Facades\Route;

// Jetstream routes
require __DIR__ . '/jetstream.php';
// Auth routes by jetstream
require __DIR__ . '/auth/routes.php';
// Admin routes
require __DIR__ . '/admin/routes.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/map', function () {
    return view('recycling-centre-map');
})->name('map');
Route::post('/search', [SearchResultController::class, 'index']);

Route::get('/blog', function () {
    return view('blog');
})->name('blog');
