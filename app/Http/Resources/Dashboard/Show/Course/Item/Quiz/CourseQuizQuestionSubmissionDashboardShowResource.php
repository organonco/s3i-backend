<?php

namespace App\Http\Resources\Dashboard\Show\Course\Item\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizQuestionSubmissionResource;
use Illuminate\Http\Request;

class CourseQuizQuestionSubmissionDashboardShowResource extends CourseQuizQuestionSubmissionResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['quiz_question'] = CourseQuizQuestionDashboardShowResource::make($this->courseQuizQuestion);
        return $base;
    }
}
