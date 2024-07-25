<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('dashboard', [AuthController::class, 'dashboard'])
        ->middleware('auth:sanctum');

Route::get('/cards', [CardController::class, 'index']);
Route::get('/cards/{id}', [CardController::class, 'show']);
Route::get('/cards/search/{title}', [CardController::class, 'search']);



// Route publique pour récupérer toutes les catégories
Route::get('/categories', [CategoryController::class, 'index']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // Card routes
    Route::post('/cards', [CardController::class, 'store']);
    Route::put('/cards/{id}', [CardController::class, 'update']);
    Route::delete('/cards/{id}', [CardController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Category routes
    // Route::apiResource('categories', CategoryController::class);
    Route::get('/category-details/{id}', [CategoryController::class, 'showCategoryDetails']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);

    Route::post('/themes', [ThemeController::class, 'store']);

    // Theme routes
    Route::apiResource('themes', ThemeController::class);

    // Review routes
    Route::apiResource('reviews', ReviewController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
