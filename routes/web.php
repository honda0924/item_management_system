<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/items', [App\Http\Controllers\ItemsController::class, 'index']);
Route::get('/item/create', [App\Http\Controllers\ItemsController::class, 'create']);
Route::get('/inquiry', [App\Http\Controllers\InquiryController::class, 'index']);
