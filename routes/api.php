<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\EmplayeeController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PosController;

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


Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});
// Route::apiResource('/employee',[EmplayeeController::class]);
Route::resource('/employee',EmplayeeController::class);
Route::resource('/customer',CustomerController::class);
Route::resource('/category',CategoryController::class);
Route::resource('/products',ProductsController::class);
Route::get('/vats', [CardController::class, 'Vats']);
//cart
Route::get('/addTocart/{id}', [CardController::class, 'AddToCart']);
Route::get('/cart/product', [CardController::class, 'CartProduct']);
Route::get('/remove/cart/{id}', [CardController::class, 'removeCart']);
Route::get('/increment/cart/{id}', [CardController::class, 'Increment']);
Route::get('/decrement/cart/{id}', [CardController::class, 'Decrement']);

//order
Route::post('/orderdone', [PosController::class, 'OrderDone']);
// Route::get('/orderdone', [OrderController::class, 'OrderDone']);


