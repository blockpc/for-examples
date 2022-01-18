<?php

use App\Http\Controllers\VehiclesController;
use App\Http\Livewire\Blog\Articles;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Vehicles Route
Route::get('/vehicles', VehiclesController::class)->name('vehicles');

// Blog Route
Route::get('/articles', Articles::class)->name('articles');