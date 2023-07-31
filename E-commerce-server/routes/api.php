<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/sign_up', [RegisterController::class, 'add_user']);
Route::post('/sign_in', [RegisterController::class, 'login']);

Route::post('/add_product', [ProductController::class, 'addProduct']);
Route::post('/update_product', [ProductController::class, 'updateProduct']);
Route::post('/delete_product', [ProductController::class, 'deleteProduct']);
Route::get('/get_products', [ProductController::class, 'getProducts']);

Route::post('/add_to_cart', [PurchaseController::class, 'addToCart']);
