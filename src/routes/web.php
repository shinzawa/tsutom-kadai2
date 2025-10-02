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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/register', function () {
    return view('register');
});

Route::get('/products/{productId}', [ProductController::class, 'product']);

Route::get('/products', [ProductController::class, 'products']);

Route::post('/products/register', [ProductController::class, 'register']);

Route::post('/products/search', [ProductController::class, 'search']);

Route::patch('/products/{productId}/update', [ProductController::class, 'update']);

Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy']);
