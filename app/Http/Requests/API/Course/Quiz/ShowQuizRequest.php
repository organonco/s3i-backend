<?php

namespace App\Http\Requests\API\Course\Quiz;

use App\Http\Requests\API\Request;

/**
 * @urlParam id string required
 */
class ShowQuizRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
}