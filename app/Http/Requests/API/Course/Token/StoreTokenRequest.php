<?php

namespace App\Http\Requests\API\Course\Token;

use App\Http\Requests\API\Request;

class StoreTokenRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required',
        ];
    }

    public function getToken()
    {
        return $this->input('token');
    }
}
