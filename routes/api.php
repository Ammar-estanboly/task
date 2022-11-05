<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('show-profile', [UserController::class, 'show_profile']);
    Route::post('change-password', [UserController::class, 'change_password']);
    Route::get('show-your-products', [UserController::class, 'show_your_products']);

});

Route::middleware('auth:api')->prefix('dashboard')->group(function () {
    //product api
    Route::post('add-product', [ProductController::class, 'add']);
    Route::post('edit-product', [ProductController::class, 'edit']);
    Route::get('show-products', [ProductController::class, 'show']);
    Route::get('show-product/{id}', [ProductController::class, 'show_product']);
    Route::delete('delete-product/{id}', [ProductController::class, 'delete']);


    //user api
    Route::post('add-user', [UserController::class, 'add']);
    Route::get('show-user-profile/{id}', [UserController::class, 'show_user_profile']);
    Route::put('update-user/{id}', [UserController::class, 'update']);
    Route::delete('delete-user/{id}', [UserController::class, 'delete']);
    Route::post('assing-product', [UserController::class, 'assign']);
    Route::get('show-user-product/{id}', [UserController::class, 'show_user_product']);

});

