<?php

namespace App\Http\Requests\API\Course\Homework;

use App\Http\Requests\API\Request;
use App\Models\Course;
use App\Models\CourseHomework;
use App\Models\CourseItem;
use App\Traits\ChecksSubscription;

class StoreHomeworkRequest extends Request
{
    use ChecksSubscription;
    public function authorize(): bool
    {
        $item = CourseItem::byHash($this->id);
        return $item && $this->isSubscribedToCourse($item->course_id) && $item->item instanceof CourseHomework;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:jpeg,jpg,png,pdf',
        ];
    }
}
