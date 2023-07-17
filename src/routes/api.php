<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('/create', 'store');
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/{id}', 'get');
    Route::get('/', 'index');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });

    Route::controller(CartController::class)->group(function () {
        Route::post('/cart/add', 'addToCart');
        Route::delete('/cart/{productId}', 'removeFromCart');
        Route::get('/cart', 'getCartItems');
    });
});

