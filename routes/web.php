<?php

use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\FrontendController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::resource('admin/availability', AvailabilityController::class);
});

// Frontend Routes
Route::get('availabilities', [FrontendController::class, 'showAvailability'])->name('frontend.availabilities');