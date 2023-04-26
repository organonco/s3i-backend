<?php

namespace App\Http\Resources\Model\Course;

use App\Http\Resources\Model\Course\CourseItems\CourseItemAPIResource;
use Illuminate\Http\Request;

class CourseShowAPIResource extends CourseBaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['items'] = $this->courseItems()->orderBy('order')->get()->transform(function ($item) {
            return new CourseItemAPIResource($item);
        });
        return $base;
    }
}
