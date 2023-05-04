<?php

namespace App\Http\Resources\Dashboard\Show\Course\Item\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizResource;
use Illuminate\Http\Request;

class CourseQuizDashboardShowResource extends CourseQuizResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['questions'] = CourseQuizQuestionDashboardShowResource::collection($this->whenLoaded('questions'));
        return $base;
    }
}
