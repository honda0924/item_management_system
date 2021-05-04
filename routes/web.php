<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/items', [App\Http\Controllers\ItemsController::class, 'index'])->name('items');
Route::get('/item/create', [App\Http\Controllers\ItemsController::class, 'create'])->name("item.create");
Route::post('/item/post', [App\Http\Controllers\ItemsController::class, 'post'])->name("item.post");
Route::get('/item/confirm', [App\Http\Controllers\ItemsController::class, 'confirm'])->name("item.confirm");
Route::post('/item/send', [App\Http\Controllers\ItemsController::class, 'send'])->name("item.send");
Route::get('/item/complete', [App\Http\Controllers\ItemsController::class, 'complete'])->name("item.complete");

Route::get('/inquiry', [App\Http\Controllers\InquiryController::class, 'index'])->name('inquiry');
Route::post('/inquiry/post', [App\Http\Controllers\InquiryController::class, 'post'])->name("inquiry.post");
Route::get('/inquiry/confirm', [App\Http\Controllers\InquiryController::class, 'confirm'])->name('inquiry.confirm');
Route::post('/inquiry/send', [App\Http\Controllers\InquiryController::class, 'send'])->name('inquiry.send');
Route::get('/inquiry/complete', [App\Http\Controllers\InquiryController::class, 'complete'])->name('inquiry.complete');
