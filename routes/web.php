<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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



//User
Route::get('/admin/user', [UserController::class, 'getAllUsers']);

Route::get('/admin/user/{id}', [UserController::class, 'detailUser']);

Route::get('/admin/users/create', [UserController::class, 'createUser']);
Route::post('/admin/user/create', [UserController::class, 'handleCreateUser']);

Route::get('/admin/user/update/{id}', [UserController::class, 'updateUser']);
Route::post('/admin/user/update/{id}', [UserController::class, 'handleUpdateUser']);

Route::get('/admin/user/delete/{id}', [UserController::class, 'deleteUser']);
Route::post('/admin/user/delete/{id}', [UserController::class, 'handleDeleteUser']);