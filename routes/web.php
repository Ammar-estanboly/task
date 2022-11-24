<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
require __DIR__.'/auth.php';

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('show-profile', [UserController::class, 'show_profile'])->name('show-profile');
    Route::get('change-password', [UserController::class, 'show_change_password'])->name('show-change-password');
    Route::post('change-password', [UserController::class, 'change_password'])->name('change-password');
    Route::get('show-your-products', [UserController::class, 'show_your_products'])->name('show-your-products');

    Route::get('add-user', [UserController::class, 'add'])->name('show-add-user');
    Route::post('add-user', [UserController::class, 'store'])->name('store-user');
    Route::get('show-users', [UserController::class, 'show_users'])->name('show-users');
    Route::get('show-user-product/{id}', [UserController::class, 'show_user_product'])->name('show-user-product');
    Route::get('show-user-profile/{id}', [UserController::class, 'show_user_profile'])->name('show-user');
    Route::get('update-user/{id}', [UserController::class, 'update'])->name('update-user');
    Route::post('update-user/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::post('delete-user', [UserController::class, 'delete'])->name('delete-user');
    Route::post('assing-product', [UserController::class, 'assign'])->name('assing-product');
    Route::get('assing-product/{id}', [UserController::class, 'show_assign'])->name('show-assing-product');


        //product api
    Route::get('add-product', [ProductController::class, 'show_add_form'])->name('show_add-product');
    Route::post('add-product', [ProductController::class, 'add'])->name('add-product');
    Route::get('edit-product/{id}', [ProductController::class, 'show_edit'])->name('show-edit-product');
    Route::post('edit-product', [ProductController::class, 'edit'])->name('edit-product');
    Route::get('show-products', [ProductController::class, 'show'])->name('show-products');
    Route::get('show-product/{id}', [ProductController::class, 'show_product']);
    Route::post('delete-product', [ProductController::class, 'delete'])->name('delete-product');



});
Route::get('/{page}', [AdminController::class,'index']);




