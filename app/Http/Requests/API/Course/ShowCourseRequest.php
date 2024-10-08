<?php

namespace App\Http\Requests\API\Course;

use App\Http\Requests\API\Request;

/**
 * @urlParam id string required
 */
class ShowCourseRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
}
