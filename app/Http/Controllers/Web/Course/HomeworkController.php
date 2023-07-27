<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Models\CourseHomeworkSubmission;
use App\Notifications\HomeworkFeedbackAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeworkController extends Controller
{
    public function submitFeedback(string $hash, Request $request)
    {
        $request->validate([
            'feedback' => 'required'
        ]);
        $submission = CourseHomeworkSubmission::byHash($hash);
        $submission->update([
            'feedback' => $request->input('feedback')
        ]);

        $submission->student->notify(
            new HomeworkFeedbackAdded($submission->courseHomework)
        );
    }

    public function removeFeedback(string $hash, Request $request)
    {
        $submission = CourseHomeworkSubmission::byHash($hash);
        $submission->update([
            'feedback' => null
        ]);
    }
}
