<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'index'])->name('search.form');
Route::post('/search', [SearchController::class, 'search'])->name('search.perform');
