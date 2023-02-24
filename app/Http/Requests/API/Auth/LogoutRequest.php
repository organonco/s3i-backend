<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\Request;

class LogoutRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
}
