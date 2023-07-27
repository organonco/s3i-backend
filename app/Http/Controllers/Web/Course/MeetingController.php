<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Models\Classroom;
use App\Models\CourseMeeting;
use App\Notifications\MeetingSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
        $classroom = Classroom::byHash($request->input('classroom_id'));
        $classroom_id = $classroom->id;

        $courseMeeting->classroomMeetings()->updateOrCreate(['classroom_id' => $classroom_id], [
            'url' => $request->input('url'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'classroom_id' => $classroom_id,
        ]);
        Notification::send($classroom->students, new MeetingSet($courseMeeting));
    }
}