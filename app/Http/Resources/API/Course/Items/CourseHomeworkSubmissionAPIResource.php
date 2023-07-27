<?php

namespace App\Http\Resources\API\Course\Items;

use App\Http\Resources\Base\Course\Items\CourseHomeworkResource;
use App\Http\Resources\Base\Course\Items\CourseHomeworkSubmissionResource;
use App\Models\CourseHomeworkSubmission;
use Illuminate\Http\Request;

class CourseHomeworkSubmissionAPIResource extends CourseHomeworkSubmissionResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['id']);
        unset($base['student_name']);
        unset($base['homework_id']);
        unset($base['homework_name']);
        return $base;
    }
}
