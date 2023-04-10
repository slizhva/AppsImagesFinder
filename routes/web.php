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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/images', [App\Http\Controllers\ImagesController::class, 'index'])->name('images');
Route::post('/images/find', [App\Http\Controllers\ImagesController::class, 'find'])->name('images.find');
