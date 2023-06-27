<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Models\CourseHomeworkSubmission;
use Illuminate\Http\Request;

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
    }
}
