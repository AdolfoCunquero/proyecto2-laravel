<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\UserController;

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

/*Route::apiResource("category","CategoryController");*/

Route::middleware('auth:sanctum')->group( function () {
    
});

Route::get('/category', [CategoryController::class, 'index']);
Route::get('/categoryActive', [CategoryController::class, 'getCategoryActive']);

Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'delete']);

Route::get('/article', [ArticleController::class, 'index']);
Route::get('/articleActive/{category_id}', [ArticleController::class, 'getArticleActive']);
Route::get('/searchArticle/{article_search}', [ArticleController::class, 'searchArticle']);

Route::post('/article', [ArticleController::class, 'store']);
Route::put('/article/{id}', [ArticleController::class, 'update']);
Route::delete('/article/{id}', [ArticleController::class, 'delete']);

Route::get('/customer', [CustomerController::class, 'index']);
Route::get('/customerActive', [CustomerController::class, 'getCustomerActive']);

Route::post('/customer', [CustomerController::class, 'store']);
Route::put('/customer/{id}', [CustomerController::class, 'update']);
Route::delete('/customer/{id}', [CustomerController::class, 'delete']);

Route::get('/order', [OrderController::class, 'index']);
Route::post('/order', [OrderController::class, 'store']);
Route::put('/order/{id}', [OrderController::class, 'update']);
Route::delete('/order/{id}', [OrderController::class, 'delete']);

Route::get('/orderDetail/{order_id}', [OrderDetailController::class, 'index']);
Route::post('/orderDetail', [OrderDetailController::class, 'store']);
Route::put('/orderDetail/{id}', [OrderDetailController::class, 'update']);
Route::delete('/orderDetail/{id}', [OrderDetailController::class, 'delete']);


Route::get('/images/{file_name}', [ArticleController::class, 'download']);


Route::post('/register', [UserController::class, 'signup']);
Route::post('/signin', [UserController::class, 'signin']);