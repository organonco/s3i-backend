<?php

namespace App\Http\Requests\API\Student\Profile;

use App\Http\Requests\API\Request;

class ShowProfileRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
}
