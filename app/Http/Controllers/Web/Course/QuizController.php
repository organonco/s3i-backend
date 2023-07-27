<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Dashboard\Show\Course\Item\Quiz\CourseQuizSubmissionDashboardShowResource;
use App\Models\QuizSubmission;
use App\Notifications\QuizFeedbackAdded;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function showSubmission(string $hash)
    {
        $quizSubmission = QuizSubmission::byHash($hash);
        return CourseQuizSubmissionDashboardShowResource::make($quizSubmission);
    }

    public function addFeedback(string $hash, Request $request)
    {
        $quizSubmission = QuizSubmission::byHash($hash);
        $request->validate([
            'feedback' => 'required',
        ]);
        $quizSubmission->update(['feedback' => $request->input('feedback')]);
        $quizSubmission->student->notify(new QuizFeedbackAdded($quizSubmission->courseQuiz));
    }

    public function removeFeedback(string $hash, Request $request)
    {
        $quizSubmission = QuizSubmission::byHash($hash);
        $quizSubmission->update(['feedback' => null]);
    }
}