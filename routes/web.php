<?php

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

Route::get('/', [\App\Http\Controllers\Web\User\HomeController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\Web\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Web\User\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\Web\User\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('can:edit-settings')->group(function () {
        Route::resource('category', \App\Http\Controllers\Web\Course\CategoryController::class);
        Route::resource('nationality', \App\Http\Controllers\Web\Student\NationalityController::class);
        Route::resource('education_level', \App\Http\Controllers\Web\Student\EducationLevelController::class);
        Route::resource('course', \App\Http\Controllers\Web\Course\CourseController::class);
        Route::resource('student', \App\Http\Controllers\Web\Student\StudentController::class);
        Route::resource('course_token', \App\Http\Controllers\Web\Course\TokenController::class);
        Route::resource('teacher', \App\Http\Controllers\Web\User\TeacherController::class);
        Route::get('course_token/{id}/export', [\App\Http\Controllers\Web\Course\TokenController::class, 'export'])->name('course_token.export');
        Route::put('student/{student}/unfreeze', [\App\Http\Controllers\Web\Student\StudentController::class, 'unfreeze'])->name('student.unfreeze');
    });
    Route::resource('classroom', \App\Http\Controllers\Web\Course\ClassroomController::class)->only('index');
    Route::get('classroom/{hash}/students', [\App\Http\Controllers\Web\Course\ClassroomController::class, 'getStudents'])->name('classroom.students');
    Route::get('classroom/{hash}/quizzes', [\App\Http\Controllers\Web\Course\ClassroomController::class, 'getQuizzes'])->name('classroom.quizzes');
    Route::get('classroom/{hash}/homeworks', [\App\Http\Controllers\Web\Course\ClassroomController::class, 'getHomeworks'])->name('classroom.homeworks');
    Route::get('classroom/{hash}/meetings', [\App\Http\Controllers\Web\Course\ClassroomController::class, 'getMeetings'])->name('classroom.meetings');

    Route::post('homework/{hash}/feedback', [\App\Http\Controllers\Web\Course\HomeworkController::class, 'submitFeedback'])->name('homework.feedback');
    Route::delete('homework/{hash}/feedback', [\App\Http\Controllers\Web\Course\HomeworkController::class, 'removeFeedback'])->name('homework.feedback.destroy');

    Route::get('quiz/{hash}', [\App\Http\Controllers\Web\Course\QuizController::class, 'showSubmission'])->name('quiz.submission.show');
    Route::post('quiz/{hash}/feedback', [\App\Http\Controllers\Web\Course\QuizController::class, 'addFeedback'])->name('quiz.submission.feedback');
    Route::delete('quiz/{hash}/feedback', [\App\Http\Controllers\Web\Course\QuizController::class, 'removeFeedback'])->name('quiz.submission.feedback.destroy');

    Route::post('meeting/{hash}/information', [\App\Http\Controllers\Web\Course\MeetingController::class, 'addInformation'])->name('meeting.information');
});

require __DIR__ . '/auth.php';
