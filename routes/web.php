<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [\App\Http\Controllers\Web\User\HomeController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Web\User\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\Web\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Web\User\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\Web\User\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('category', \App\Http\Controllers\Web\Course\CategoryController::class);
    Route::resource('nationality', \App\Http\Controllers\Web\Student\NationalityController::class);
    Route::resource('education_level', \App\Http\Controllers\Web\Student\EducationLevelController::class);
    Route::resource('course', \App\Http\Controllers\Web\Course\CourseController::class);
    Route::resource('student', \App\Http\Controllers\Web\Student\StudentController::class);
    Route::put('student/{student}/unfreeze', [\App\Http\Controllers\Web\Student\StudentController::class, 'unfreeze'])->name('student.unfreeze');
});

require __DIR__.'/auth.php';
