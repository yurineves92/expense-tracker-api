<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
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
// Authentication
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('register', [AuthController::class, 'register'])->name('auth.register');


// Authenticated
Route::middleware('auth:api')->group(function () {
   Route::get('/profile', [UserController::class, 'userInfo'])->name('userInfo');
   Route::put('/user/{id}', [UserController::class , 'update'])->name('user.update');
   Route::delete('/user/{id}', [UserController::class , 'delete'])->name('user.delete');

   // Categories
   Route::get('categories', [CategoryController::class, 'index'])->name('category.index');
   Route::get('categories/{id}', [CategoryController::class, 'show'])->name('category.show');
   Route::put('categories/{id}', [CategoryController::class, 'update'])->name('category.update');
   Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});