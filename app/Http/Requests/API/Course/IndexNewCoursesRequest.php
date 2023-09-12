<?php

namespace App\Http\Requests\API\Course;

use App\Http\Requests\API\Request;

/**
 * @queryParam category_id optional
 */
class IndexNewCoursesRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
}
