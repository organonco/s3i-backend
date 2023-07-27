<?php

namespace App\Http\Resources\API\Course\Items;

use App\Http\Resources\Base\Course\Items\CourseHomeworkResource;
use App\Models\CourseHomeworkSubmission;
use App\Traits\ChecksSubscription;
use Illuminate\Http\Request;

class CourseHomeworkAPIResource extends CourseHomeworkResource
{
    use ChecksSubscription;

    public function toArray(Request $request): array
    {
        $student = $this->getAuthenticatedStudent();
        $base = parent::toArray($request);
        $submission = CourseHomeworkSubmission::query()->students([$student->id])->homeworks([$this->id])->first();
        if (!is_null($submission))
            $base['submission'] = CourseHomeworkSubmissionAPIResource::make($submission);
        return $base;
    }
}
