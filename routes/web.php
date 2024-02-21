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
    return view('auth.login');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/store-event', [App\Http\Controllers\HomeController::class, 'store'])->name('store-event')->middleware('auth');
Route::get('/fetch-data', [App\Http\Controllers\HomeController::class, 'fetch'])->name('fetch-data')->middleware('auth');
Route::post('/archive', [App\Http\Controllers\HomeController::class, 'archive'])->name('archive')->middleware('auth');
Route::get('/archive', [App\Http\Controllers\HomeController::class, 'index_arhive'])->name('archive')->middleware('auth');



