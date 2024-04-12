<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
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
Route::get('/recycle-point-map', [MapController::class, 'index'])->name('recycle-point-map');
Route::get('/search', [SearchResultController::class, 'index'])->name('item-search');
Route::post('/search', [SearchResultController::class, 'sendItemRequest']);

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('article');

Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
Route::post('/about-us', [AboutUsController::class, 'contact'])->name('contact');
