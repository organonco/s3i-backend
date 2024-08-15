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

Route::group(['middleware' => 'guest'], function () {
	Route::post('/login', \App\Http\Controllers\API\Auth\LoginController::class)->name('login');
    Route::get('/register', [\App\Http\Controllers\API\Auth\RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [\App\Http\Controllers\API\Auth\RegisterController::class, 'store'])->name('register.store');

	Route::post('/verification/send', [\App\Http\Controllers\API\Auth\VerifyController::class, 'send'])->middleware('throttle:5,1')->name('verify.send');
	Route::post('/verification/verify/{verification_hash}', [\App\Http\Controllers\API\Auth\VerifyController::class, 'verify'])->middleware('throttle:5,1')->name('verify.verify');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', \App\Http\Controllers\API\Auth\LogoutController::class)->name('logout');
    Route::controller(\App\Http\Controllers\API\Student\ProfileController::class)->group(function () {
        Route::get('/profile', 'show');
        Route::put('/profile', 'update');
        Route::post('/reset-password', 'resetPassword');
    });

    Route::get('/notifications', [\App\Http\Controllers\API\Student\NotificationController::class, 'index']);
    Route::get('/notifications/count', [\App\Http\Controllers\API\Student\NotificationController::class, 'count']);
    Route::get('/notifications/{id}/mark-as-read', [\App\Http\Controllers\API\Student\NotificationController::class, 'markAsRead']);

    Route::resource('/token', \App\Http\Controllers\API\Course\TokenController::class)->only(['store']);
    Route::get('/course/my-courses', [\App\Http\Controllers\API\Course\CourseController::class, 'indexMyCourses'])->name('course.my-courses');


    Route::get('/homework/{id}', [\App\Http\Controllers\API\Course\HomeworkController::class, 'show']);
    Route::post('/homework/{id}', [\App\Http\Controllers\API\Course\HomeworkController::class, 'submit']);
    Route::get('/quiz/{id}', [\App\Http\Controllers\API\Course\QuizController::class, 'show']);
    Route::post('/quiz/{id}', [\App\Http\Controllers\API\Course\QuizController::class, 'submit']);

    Route::post('/purchase/course', [\App\Http\Controllers\API\Course\PurchaseController::class, 'purchaseCourse']);
});

Route::resource('/category', \App\Http\Controllers\API\Course\CategoryController::class)->only(['index']);
Route::get('/course/new', [\App\Http\Controllers\API\Course\CourseController::class, 'indexNew']);
Route::resource('/course', \App\Http\Controllers\API\Course\CourseController::class)->only(['index', 'show']);
Route::resource('/teachers', \App\Http\Controllers\API\Teacher\TeacherController::class)->only(['index']);
