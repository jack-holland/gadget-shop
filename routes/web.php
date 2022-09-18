<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

// Index
Route::get('/', function () { return view('index'); })->name('index');

// Product Categories
Route::get('/computers', [ProductController::class, 'showComputers']);
Route::get('/laptops', [ProductController::class, 'showLaptops']);
Route::get('/mobiles', [ProductController::class, 'showMobiles']);
Route::get('/televisions', [ProductController::class, 'showTelevisions']);

// Display Product
Route::get('product/{id}', [ProductController::class, 'showProduct'])->name('showproduct');

// Search
Route::post('/search',[App\Http\Controllers\UserController::class, 'search'])->name('search');
// Shopping Cart
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductController::class, 'updateCart'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

// User/Admin System
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    // Account
    Route::get('/account', [App\Http\Controllers\HomeController::class, 'index'])->name('account');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'showOrder'])->name('orders');
    Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'showOrderById'])->name('order');

    // Change Password
    Route::get('/account/password',[App\Http\Controllers\HomeController::class, 'showChangePasswordGet'])->name('password');
    Route::post('/account/password',[App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');

    // Change Details
    Route::get('/account/details',[App\Http\Controllers\HomeController::class, 'showChangeDetailsGet'])->name('details');
    Route::post('/account/details',[App\Http\Controllers\HomeController::class, 'changeDetailsPost'])->name('changeDetailsPost');

    // Roles, User and Products Management
    Route::resource('admin/roles', RoleController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('admin/products', ProductController::class);
    Route::resource('admin/orders', OrderController::class);

    // Order Complete
    Route::get('/ordercomplete',[App\Http\Controllers\OrderController::class, 'ordercomplete'])->name('ordercomplete');

    // Purchase Product
    Route::post('cart', [ProductController::class, 'purchase'])->name('purchase');
});