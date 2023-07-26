<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Dashboard\Show\Course\Item\Quiz\CourseQuizSubmissionDashboardShowResource;
use App\Models\Classroom;
use App\Models\CourseMeeting;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;

class MeetingController extends Controller
{

    public function addInformation(string $hash, Request $request)
    {
        $courseMeeting = CourseMeeting::byHash($hash);
        $request->validate([
            'url' => 'required|url',
            'date' => 'required|date',
            'time' => 'required',
            'classroom_id' => 'required',
        ]);
        $classroom_id = Classroom::hashToId($request->input('classroom_id'));

        $courseMeeting->classroomMeetings()->updateOrCreate(['classroom_id' => $classroom_id], [
            'url' => $request->input('url'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'classroom_id' => $classroom_id,
        ]);
    }
}