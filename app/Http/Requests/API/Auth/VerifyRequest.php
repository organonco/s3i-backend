<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\Request;

class VerifyRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'code' => 'required',
        ];
    }
    public function getCode()
    {
        return $this->input('code');
    }
}
