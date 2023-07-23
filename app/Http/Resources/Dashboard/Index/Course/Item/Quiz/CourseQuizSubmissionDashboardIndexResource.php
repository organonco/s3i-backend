<?php

namespace App\Http\Resources\Dashboard\Index\Course\Item\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizQuestionResource;
use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizSubmissionResource;
use Illuminate\Http\Request;

class CourseQuizSubmissionDashboardIndexResource extends CourseQuizSubmissionResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['submission_url'] = route('quiz.submission.show', $this->hash);
        return $base;
    }
}
