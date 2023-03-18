<?php

namespace App\Http\Resources\Model\Course;

use Illuminate\Http\Request;

class CourseIndexResource extends CourseBaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['introduction_video_url']);
        return $base;
    }
}
