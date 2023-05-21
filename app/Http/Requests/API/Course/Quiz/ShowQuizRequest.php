<?php

namespace App\Http\Requests\API\Course\Quiz;

use App\Http\Requests\API\Request;
use App\Models\Course;
use App\Models\CourseItem;
use App\Models\CourseQuiz;

/**
 * @urlParam id string required
 */
class ShowQuizRequest extends Request
{
    public function authorize(): bool
    {
        $item = CourseItem::byHash($this->id);
        return $this->user()->can('viewDetails', [Course::class, $item->course_id]) && $item->item instanceof CourseQuiz;
    }
}
