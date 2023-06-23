<?php

namespace App\Http\Resources\Dashboard\Index\Course;

use App\Http\Resources\Base\Course\ClassroomResource;
use Illuminate\Http\Request;

class ClassroomDashboardIndexResource extends ClassroomResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['course'] = CourseDashboardIndexResource::make($this->course);
        $base['number_of_students'] = $this->number_of_students;
        return $base;
    }
}
