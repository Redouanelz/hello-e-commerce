<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/{pathMatch}',function() {
    return view('welcome');
});

Route::get('/api/products', [ProductController::class, 'index']);
Route::get('/api/product/{id}', [ProductController::class, 'show']);

Route::get('/api/cart', [CartController::class, 'index']);
Route::get('/api/cart/{id}', [CartController::class, 'show']);
Route::post('/api/cart/add', [CartController::class, 'add']);
Route::post('/api/cart/remove', [CartController::class, 'remove']);
Route::post('/api/cart/clear', [CartController::class, 'clear']);

// Increase the quantity of the cart item
Route::post('/api/cart/addquantity', [CartController::class, 'increaseQuantity']);

// Decrease the quantity of the cart item
Route::post('/api/cart/removequantity', [CartController::class, 'decreaseQuantity']);

use App\Http\Controllers\AuthController;
Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/login', [AuthController::class, 'login']);

use App\Http\Controllers\PayController;
Route::get('/api/pay/{id}', [PayController::class, 'show']);
Route::post('/api/pay/add', [PayController::class, 'add']);


use App\Http\Controllers\AvisController;
Route::get('/api/avis/{id}', [AvisController::class, 'show']);
Route::post('/api/avis/add', [AvisController::class, 'add']);



