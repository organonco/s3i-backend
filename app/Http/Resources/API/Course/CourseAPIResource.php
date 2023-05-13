<?php

namespace App\Http\Resources\API\Course;

use App\Http\Resources\API\Course\Items\CourseItemAPIResource;
use App\Http\Resources\Base\Course\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseAPIResource extends CourseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['students_limit']);

        $isSubscribed = false;
        if (auth('sanctum')->check())
            $isSubscribed = auth('sanctum')->user()->can('viewDetails', [Course::class, $this->id]);

        $base['items'] = $this->when($isSubscribed, CourseItemAPIResource::collection($this->whenLoaded('courseItems')));
        $base['is_subscribed'] = $isSubscribed;
        return $base;
    }
}
