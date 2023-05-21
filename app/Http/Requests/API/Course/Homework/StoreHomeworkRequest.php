<?php

namespace App\Http\Requests\API\Course\Homework;

use App\Http\Requests\API\Request;
use App\Models\Course;
use App\Models\CourseHomework;
use App\Models\CourseItem;

class StoreHomeworkRequest extends Request
{
    public function authorize(): bool
    {
        $item = CourseItem::byHash($this->id);
        return $this->user()->can('viewDetails', [Course::class, $item->course_id]) && $item->item instanceof CourseHomework;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:jpeg,jpg,png,pdf',
        ];
    }
}
