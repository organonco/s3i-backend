<?php

namespace App\Http\Requests\API\Student\Profile;

use App\Http\Requests\API\Request;

class ResetPasswordRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
            'new_password_confirmation' => 'required',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'old_password' => [
                'example' => '12345678',
            ],
            'new_password' => [
                'example' => '87654321'
            ],
            'new_password_confirmation' => [
                'example' => '87654321',
            ],
        ];
    }
}
