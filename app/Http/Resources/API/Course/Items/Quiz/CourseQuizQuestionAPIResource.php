<?php

namespace App\Http\Resources\API\Course\Items\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizQuestionResource;
use Illuminate\Http\Request;

class CourseQuizQuestionAPIResource extends CourseQuizQuestionResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['options'] = CourseQuizQuestionOptionAPIResource::collection($this->options);
        return $base;
    }
}
