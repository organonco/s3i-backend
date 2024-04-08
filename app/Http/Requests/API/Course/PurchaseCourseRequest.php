<?php

namespace App\Http\Requests\API\Course;

use App\Http\Requests\API\Request;
use Veelasky\LaravelHashId\Rules\ExistsByHash;

class PurchaseCourseRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => ['required', new ExistsByHash(\App\Models\Course::class)],
        ];
    }

    public function getCourseId(): string
    {
        return \App\Models\Course::hashToId($this->input('course_id'));
    }
}
