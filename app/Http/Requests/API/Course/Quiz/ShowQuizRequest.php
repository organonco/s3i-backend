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
class ShowQuizRequest extends Request
{
    use ChecksSubscription;
    public function authorize(): bool
    {
        $item = CourseItem::byHash($this->id);
        return $item && $this->isSubscribedToCourse($item->course_id) && $item->item instanceof CourseQuiz;
    }
}
