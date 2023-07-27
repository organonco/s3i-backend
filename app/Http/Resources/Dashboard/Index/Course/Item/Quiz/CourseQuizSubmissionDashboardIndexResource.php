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
        $base['id'] = $this->hash;
        $base['student_name'] = $this->student->name_ar;
        $base['quiz_id'] = $this->courseQuiz->hash;
        $base['quiz_name'] = $this->courseQuiz->name;
        $base['quiz_type'] = $this->courseQuiz->type;
        return $base;
    }
}
