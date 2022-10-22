<?php

use App\Http\Controllers\Api\MerchantController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StoreController;
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

Route::prefix('merchants')->group(function () {
    Route::get('', [MerchantController::class, 'index']);
    Route::get('{merchant}', [MerchantController::class, 'show']);
    Route::post('', [MerchantController::class, 'store']);
    Route::put('{merchant}', [MerchantController::class, 'update']);
    Route::delete('{merchant}', [MerchantController::class, 'delete']);
});


Route::prefix('stores')->group(function () {
    Route::get('', [StoreController::class, 'index']);
    Route::get('{store}', [StoreController::class, 'show']);
    Route::post('', [StoreController::class, 'store']);
    Route::put('{store}', [StoreController::class, 'update']);
    Route::delete('{store}', [StoreController::class, 'delete']);
});

Route::prefix('/products')->group(function () {
    Route::get('', [ProductController::class, 'index']);
    Route::get('{product}', [ProductController::class, 'show']);
    Route::post('', [ProductController::class, 'store']);
    Route::put('{product}', [ProductController::class, 'update']);
    Route::delete('{product}', [ProductController::class, 'delete']);
});
