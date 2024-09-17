<?php

namespace App\Http\Requests\API\Auth;

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
            'code' => 'required',
			'password' => 'required|min:8|confirmed'
        ];
    }
    public function getCode()
    {
        return $this->input('code');
    }
	public function getPasswordInput()
	{
		return $this->input('password');
	}
}
