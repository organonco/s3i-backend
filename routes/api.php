<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function(){
    Route::post('/login', \App\Http\Controllers\API\Auth\LoginController::class)->name('login');
    Route::post('/register', \App\Http\Controllers\API\Auth\RegisterController::class)->name('register');
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('/logout', \App\Http\Controllers\API\Auth\LogoutController::class)->name('logout');
    Route::controller(\App\Http\Controllers\API\Student\ProfileController::class)->group(function () {
        Route::get('/profile', 'show');
        Route::put('/profile', 'update');
    });
});
