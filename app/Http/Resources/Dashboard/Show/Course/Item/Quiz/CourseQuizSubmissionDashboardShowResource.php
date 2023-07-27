<?php

namespace App\Http\Resources\Dashboard\Show\Course\Item\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizSubmissionResource;
use Illuminate\Http\Request;

class CourseQuizSubmissionDashboardShowResource extends CourseQuizSubmissionResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['has_feedback']);
        unset($base['feedback']);
        $base['answers'] = CourseQuizQuestionSubmissionDashboardShowResource::collection($this->quizQuestionSubmissions);
        return $base;
    }
}
