<?php

namespace App\Http\Requests\API\Student\Notifications;

use App\Http\Requests\API\Request;

class IndexRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
}
