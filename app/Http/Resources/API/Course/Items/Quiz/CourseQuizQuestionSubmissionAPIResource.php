<?php

namespace App\Http\Resources\API\Course\Items\Quiz;

use App\Enums\CourseQuizQuestionTypes;
use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizQuestionResource;
use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizQuestionSubmissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseQuizQuestionSubmissionAPIResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $question = $this->courseQuizQuestion;
        $questionResource = CourseQuizQuestionResource::make($question)->toArray($request);
        $answer = CourseQuizQuestionSubmissionResource::make($this)->toArray($request)['answer'];

        if ($question->type == CourseQuizQuestionTypes::TEXT)
            $questionResource['answer'] = $answer->text;
        elseif ($question->type == CourseQuizQuestionTypes::RADIO) {
            $questionResource['answer'] = $answer->option;
        } else {
            $questionResource['answer'] = $answer->options;
        }
        return $questionResource;
    }
}
