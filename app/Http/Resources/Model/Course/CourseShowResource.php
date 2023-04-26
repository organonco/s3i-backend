<?php

namespace App\Http\Resources\Model\Course;

use App\Http\Resources\Model\Course\CourseItems\CourseItemResource;
use Illuminate\Http\Request;

class CourseShowResource extends CourseBaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['items'] = $this->courseItems()->orderBy('order')->get()->transform(function ($item) {
            return new CourseItemResource($item);
        });
        return $base;
    }
}
