<?php

namespace App\Http\Resources\Dashboard\Index\Course;

use App\Http\Resources\Base\Course\CourseResource;
use Illuminate\Http\Request;

class CourseDashboardIndexResource extends CourseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['introduction_video_url']);
        unset($base['image_url']);
        $base['category'] = $base['category']['name'];
        return $base;
    }
}
