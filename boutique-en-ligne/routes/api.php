<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

// Public routes (accessibles sans auth)
Route::get('/products', [ProductController::class, 'apiIndex']);
Route::get('/products/{id}', [ProductController::class, 'apiShow']);
Route::get('/categories', [CategoryController::class, 'apiIndex']);
Route::get('/categories/{id}', [CategoryController::class, 'apiShow']);

// Routes protégées (version simplifiée sans auth)
Route::post('/products', [ProductController::class, 'apiStore']);
Route::put('/products/{id}', [ProductController::class, 'apiUpdate']);
Route::delete('/products/{id}', [ProductController::class, 'apiDestroy']);

Route::post('/categories', [CategoryController::class, 'apiStore']);
Route::put('/categories/{id}', [CategoryController::class, 'apiUpdate']);
Route::delete('/categories/{id}', [CategoryController::class, 'apiDestroy']);

// Si vous voulez ajouter l'auth plus tard:
// Route::middleware('auth:sanctum')->group(function () {
//     // Routes protégées ici
// });
