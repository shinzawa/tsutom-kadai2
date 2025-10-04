<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/products/register', function () {
    return view('register');
});

Route::get('/products', [ProductController::class, 'products']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::post('/products/register', [ProductController::class, 'register']);

Route::get('/products/{productId}', [ProductController::class, 'product']);
Route::post('/products/{productId}/update', [ProductController::class, 'update']);
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy']);
