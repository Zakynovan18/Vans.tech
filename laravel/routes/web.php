<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\OrderItemController;
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

// Route::get('/', function () {
//     return view('landing');
// });

Route::get('/', [ProductController::class, 'landing']);
// routes/api.php


Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('shipments', ShipmentController::class);





Route::get('/orders/{orderId}/items/create/{productId}', [OrderItemController::class, 'create'])

    ->name('order.items.create');


// Rute untuk menyimpan item ke order

Route::post('/orders/{orderId}/items', [OrderItemController::class, 'store'])

    ->name('order.items.store');


// Rute untuk menampilkan semua item dalam order

Route::get('/orders/{orderId}/items', [OrderItemController::class, 'index'])

    ->name('order.items.index');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk memproses login
Route::post('login', [AuthController::class, 'login'])->name('login.submit');


// Route untuk menampilkan form register
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');

// Route untuk memproses register
Route::post('register', [AuthController::class, 'register'])->name('register.submit');

// Route untuk menampilkan form login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk memproses login
Route::post('login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk logout
Route::post('logout', [AuthController::class, 'logout'])->middleware('user')->name('logout');

Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('user')->name('dashboard');

// Route untuk update produk
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::middleware('user')->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.destroy');
});


