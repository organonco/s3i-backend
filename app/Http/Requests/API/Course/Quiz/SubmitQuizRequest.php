<?php

namespace App\Http\Requests\API\Course\Quiz;

use App\Http\Requests\API\Request;
use App\Models\Course;
use App\Models\CourseItem;
use App\Models\CourseQuiz;
use App\Traits\ChecksSubscription;

/**
 * @urlParam id string required
 */
class SubmitQuizRequest extends Request
{
    use ChecksSubscription;
    public function authorize(): bool
    {
        $item = CourseItem::byHash($this->id);
        return $item && $this->isSubscribedToCourse($item->course_id) && $item->item instanceof CourseQuiz;
    }

    public function rules(): array
    {
        return [
            'answers' => 'array|required',
            'answers.*.question_id' => 'string|required',
            'answers.*.question_type' => 'string|required|in:text,check,radio',
            'answers.*.text_answer' => 'required_if:answers.*.question_type,text|string',
            'answers.*.selected_option' => 'required_if:answers.*.question_type,radio|string',
            'answers.*.selected_options' => 'required_if:answers.*.question_type,check|array',
            'answers.*.selected_options.*' => 'required_with:answers.*.question_type|string',
        ];
    }

    public function getAnswers()
    {
        return $this->input('answers');
    }
}
