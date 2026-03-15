<?php

use Illuminate\Support\Facades\Route;
use Iluminate\Http\Request;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
// Route::put('/products/{product}', [ProductController::class, 'update']);
// Route::patch('/products/{product}', [ProductController::class, 'update']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::patch('/products/{id}', [ProductController::class, 'update']);

// ctageory
// user
// finance
// payment