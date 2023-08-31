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
            $questionResource['options'] = $questionResource['options']->toArray($request);
            for ($i = 0; $i < sizeof($questionResource['options']); $i++) {
                $option = $questionResource['options'][$i];
                if ($answer->option == $option['id'])
                    $option['is_selected'] = true;
                else
                    $option['is_selected'] = false;
                $questionResource['options'][$i] = $option;
            }
        } else {
            $questionResource['options'] = $questionResource['options']->toArray($request);
            $questionResource['answer'] = $answer->options;
            for ($i = 0; $i < sizeof($questionResource['options']); $i++) {
                $option = $questionResource['options'][$i];
                foreach ($answer->options as $selectedOption)
                    if ($selectedOption == $option['id']) {
                        $option['is_selected'] = true;
                        break;
                    }
                    else
                        $option['is_selected'] = false;
                $questionResource['options'][$i] = $option;
            }
        }
        return $questionResource;
    }
}
