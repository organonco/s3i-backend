<?php

namespace App\Http\Resources\API\Course\Items;

use App\Http\Resources\Base\Course\Items\CourseMeetingResource;
use App\Models\ClassroomMeeting;
use App\Models\Student;
use App\Traits\ChecksSubscription;
use Illuminate\Http\Request;

class CourseMeetingAPIResource extends CourseMeetingResource
{
    use ChecksSubscription;
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $classroomId = $this->getAuthenticatedStudent()->classrooms()->where('course_id', $this->course_id)->first()->id;
        $classroomMeeting = ClassroomMeeting::ofClassroom($classroomId)->ofMeeting($this->id)->first();
        $base['is_set'] = !is_null($classroomMeeting);
        if($base['is_set']) {
            $base['url'] = $classroomMeeting->url;
            $base['time'] = $classroomMeeting->time;
            $base['date'] = $classroomMeeting->date;
        }
        return $base;
    }
}
