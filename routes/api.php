<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Define the API route for adding single product
Route::post('/add-product', [ProductController::class, 'store'])->middleware('validate_post_request_product')->name('route.add-product');

// Define the API route for adding multiple products
Route::post('/add-products', [ProductController::class, 'addProducts'])->middleware('validate_post_request_product')->name('route.add-products');

// Define the API route for deleting a product
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// Define the API route for deleting multiple products
Route::post('/products/delete-multiple', [ProductController::class, 'destroyMultiple']);

// Define the API route for show a single product
Route::get('/products/{id}', [ProductController::class, 'show']);

// Define the API route for listing all products
Route::get('/products', [ProductController::class, 'showAll']);