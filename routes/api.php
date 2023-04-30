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
    Route::get('/register', [\App\Http\Controllers\API\Auth\RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [\App\Http\Controllers\API\Auth\RegisterController::class, 'store'])->name('register.store');
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('/logout', \App\Http\Controllers\API\Auth\LogoutController::class)->name('logout');
    Route::controller(\App\Http\Controllers\API\Student\ProfileController::class)->group(function () {
        Route::get('/profile', 'show');
        Route::put('/profile', 'update');
        Route::post('/reset-password', 'resetPassword');
    });
    Route::resource('/quiz', \App\Http\Controllers\API\Course\QuizController::class)->only(['show']);
    Route::resource('/homework', \App\Http\Controllers\API\Course\HomeworkController::class)->only(['store']);
    Route::resource('/token', \App\Http\Controllers\API\Course\TokenController::class)->only(['store']);
});

Route::resource('/category', \App\Http\Controllers\API\Course\CategoryController::class)->only(['index']);
Route::resource('/course', \App\Http\Controllers\API\Course\CourseController::class)->only(['index', 'show']);
