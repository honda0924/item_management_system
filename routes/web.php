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
Route::get('/item/delete/{id}', [App\Http\Controllers\ItemsController::class, 'delete'])->name("item.delete");
Route::get('/item/edit/{id}', [App\Http\Controllers\ItemsController::class, 'edit'])->name("item.edit");
Route::post('/item/edit_post', [App\Http\Controllers\ItemsController::class, 'edit_post'])->name("item.edit_post");
Route::get('/item/edit_confirm', [App\Http\Controllers\ItemsController::class, 'edit_confirm'])->name("item.edit_confirm");
Route::post('/item/update', [App\Http\Controllers\ItemsController::class, 'update'])->name("item.update");
Route::get('/item/edit_complete', [App\Http\Controllers\ItemsController::class, 'edit_complete'])->name("item.edit_complete");

Route::get('/mypage', [App\Http\Controllers\MypageController::class, 'index'])->name("mypage.index");
Route::get('/favorite/add/{id}', [App\Http\Controllers\FavoriteController::class, 'add'])->name("favorite.add");
Route::get('/favorite/delete/{id}', [App\Http\Controllers\FavoriteController::class, 'delete'])->name("favorite.delete");


Route::post('/user/edit_post', [App\Http\Controllers\UsersController::class, 'edit_post'])->name("user.edit_post");
Route::get('/user/edit_confirm', [App\Http\Controllers\UsersController::class, 'edit_confirm'])->name("user.edit_confirm");
Route::post('/user/update', [App\Http\Controllers\UsersController::class, 'update'])->name("user.update");
Route::get('/user/edit_complete', [App\Http\Controllers\UsersController::class, 'edit_complete'])->name("user.edit_complete");

Route::get('/password/change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'edit'])->name("password.edit");
Route::patch('/password/update', [App\Http\Controllers\Auth\ChangePasswordController::class, 'update'])->name("password.update");

Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name("cart.add");
Route::get('/cart/show/{id}', [App\Http\Controllers\CartController::class, 'show'])->name("cart.show");
Route::get('/cart/delete/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name("cart.delete");
Route::get('/cart/purchase', [App\Http\Controllers\CartController::class, 'purchase'])->name("cart.purchase");

Route::get('/shippings', [App\Http\Controllers\ShippingsController::class, 'index'])->name('shippings');
Route::get('/shipping/delete/{id}', [App\Http\Controllers\ShippingsController::class, 'delete'])->name("shipping.delete");
Route::get('/shipping/edit/{id}', [App\Http\Controllers\ShippingsController::class, 'edit'])->name("shipping.edit");
Route::post('/shipping/edit_post', [App\Http\Controllers\ShippingsController::class, 'edit_post'])->name("shipping.edit_post");
Route::get('/shipping/edit_confirm', [App\Http\Controllers\ShippingsController::class, 'edit_confirm'])->name("shipping.edit_confirm");
Route::post('/shipping/update', [App\Http\Controllers\ShippingsController::class, 'update'])->name("shipping.update");
Route::get('/shipping/edit_complete', [App\Http\Controllers\ShippingsController::class, 'edit_complete'])->name("shipping.edit_complete");
Route::get('/shipping/create', [App\Http\Controllers\ShippingsController::class, 'create'])->name("shipping.create");




Route::get('/inquiry', [App\Http\Controllers\InquiryController::class, 'index'])->name('inquiry');
Route::post('/inquiry/post', [App\Http\Controllers\InquiryController::class, 'post'])->name("inquiry.post");
Route::get('/inquiry/confirm', [App\Http\Controllers\InquiryController::class, 'confirm'])->name('inquiry.confirm');
Route::post('/inquiry/send', [App\Http\Controllers\InquiryController::class, 'send'])->name('inquiry.send');
Route::get('/inquiry/complete', [App\Http\Controllers\InquiryController::class, 'complete'])->name('inquiry.complete');
