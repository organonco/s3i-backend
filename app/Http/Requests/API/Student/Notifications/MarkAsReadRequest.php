<?php

namespace App\Http\Requests\API\Student\Notifications;

use App\Http\Requests\API\Request;

class MarkAsReadRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
}
