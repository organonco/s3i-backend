<?php

namespace App\Http\Resources\API\Course\Items\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizSubmissionResource;
use Illuminate\Http\Request;

class CourseQuizSubmissionAPIResource extends CourseQuizSubmissionResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['answers'] = CourseQuizQuestionSubmissionAPIResource::collection($this->quizQuestionSubmissions);
        return $base;
    }
}