<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\OrderApiController;

/*
|--------------------------------------------------------------------------
| Product API Routes
|--------------------------------------------------------------------------
*/

Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);
Route::post('/products', [ProductApiController::class, 'store']);
Route::put('/products/{id}', [ProductApiController::class, 'update']);
Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Orders API Routes
|--------------------------------------------------------------------------
*/

Route::get('/orders', [OrderApiController::class, 'index']);
Route::delete('/orders/{id}', [OrderApiController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| POS Sales Route
|--------------------------------------------------------------------------
*/

Route::post('/pos/sale', [OrderApiController::class, 'storeSale']);