<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\Request;

class SendVerificationCodeRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'phone' => 'required',
        ];
    }
    public function getPhone()
    {
        return $this->input('phone');
    }
}
