<?php

use App\Http\Controllers\Api\AuthController;
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
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::prefix('/api')->middleware('auth:api')->group(function () {
   Route::get('/profile', [AuthController::class, 'userInfo'])->name('userInfo');
   Route::put('/user/{id}', [AuthController::class , 'update'])->name('user.update');
   Route::delete('/user/{id}', [AuthController::class , 'delete'])->name('user.delete');
});