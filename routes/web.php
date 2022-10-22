<?php

use App\Http\Controllers\Frontend\MerchantController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\StoreControllor;
use Illuminate\Support\Facades\Route;

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

Route::get('', MerchantController::class)->name('home');
Route::get('/{merchant}/stores', StoreControllor::class)->name('stores');
Route::get('/stores/{store}/products', ProductController::class)->name('products');
