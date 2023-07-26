<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Builder;

class ClassroomMeeting extends BaseModel
{
    protected $fillable = ['url', 'date', 'time', 'classroom_id', 'course_meeting_id'];

    public function courseMeeting()
    {
        return $this->belongsTo(CourseMeeting::class);
    }

    public function scopeOfClassroom(Builder $query, $classroomId)
    {
        return $query->where('classroom_id', $classroomId);
    }

    public function scopeOfMeeting(Builder $query, $meetingId)
    {
        return $query->where('course_meeting_id', $meetingId);
    }
}
