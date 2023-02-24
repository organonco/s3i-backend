<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\Request;

class LoginRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'phone' => 'required',
            'password' => 'required',
        ];
    }
    public function bodyParameters(): array
    {
        return [
            'phone' => [
                'example' => '99999999',
            ],
            'password' => [
                'example' => '12345678',
            ]
        ];
    }
}
