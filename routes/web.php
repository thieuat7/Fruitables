<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomePageController;

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

Route::get('/', [HomePageController::class, 'getHomePage']);

Route::get('/admin', [DashboardController::class, 'viewDashboard']);

//User
Route::get('/admin/user', [UserController::class, 'getAllUsers']);

Route::get('/admin/user/{id}', [UserController::class, 'detailUser']);

Route::get('/admin/users/create', [UserController::class, 'createUser']);
Route::post('/admin/user/create', [UserController::class, 'handleCreateUser']);

Route::get('/admin/user/update/{id}', [UserController::class, 'updateUser']);
Route::post('/admin/user/update/{id}', [UserController::class, 'handleUpdateUser']);

Route::get('/admin/user/delete/{id}', [UserController::class, 'deleteUser']);
Route::post('/admin/user/delete/{id}', [UserController::class, 'handleDeleteUser']);

//Product
Route::get('/admin/product', [ProductController::class, 'getAllProduct']);

Route::get('/admin/product/{id}', [ProductController::class, 'detailProduct']);

Route::get('/admin/products/create', [ProductController::class, 'createProduct']);
Route::post('/admin/product/create', [ProductController::class, 'handleCreateProduct']);

Route::get('/admin/product/update/{id}', [ProductController::class, 'updateProduct']);
Route::post('/admin/product/update/{id}', [ProductController::class, 'handleUpdateProduct']);

Route::get('/admin/product/delete/{id}', [ProductController::class, 'deleteProduct']);
Route::post('/admin/product/delete/{id}', [ProductController::class, 'handleDeleteProduct']);