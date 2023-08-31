<?php

namespace App\Http\Resources\API\Course\Items\Quiz;

use App\Enums\CourseQuizTypes;
use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizResource;
use App\Models\QuizSubmission;
use App\Traits\ChecksSubscription;
use Illuminate\Http\Request;

class CourseQuizAPIResource extends CourseQuizResource
{
    use ChecksSubscription;
    public function toArray(Request $request): array
    {
        $student = $this->getAuthenticatedStudent();
        $base = parent::toArray($request);
        $submission = QuizSubmission::query()->students([$student->id])->quizzes([$this->id])->first();

        if(is_null($submission))
            $base['questions'] = CourseQuizQuestionAPIResource::collection($this->questions);
        else {
            $submissionResource = CourseQuizSubmissionAPIResource::make($submission)->toArray($request);
            $base['questions'] = $submissionResource['answers'];
            $base['feedback'] = $submissionResource['feedback'];
            $base['has_feedback'] = $this->type == CourseQuizTypes::MULTIPLE_CHOICE ? true : $submissionResource['has_feedback'];
        }
        return $base;
    }
}
