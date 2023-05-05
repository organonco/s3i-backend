<?php

namespace App\Http\Resources\API\Course\Items\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizResource;
use Illuminate\Http\Request;

class CourseQuizAPIResource extends CourseQuizResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['questions'] = CourseQuizQuestionAPIResource::collection($this->questions);
        return $base;
    }
}
