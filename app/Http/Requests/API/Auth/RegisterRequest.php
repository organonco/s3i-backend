<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\Request;

class RegisterRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'phone' => 'required|min:8|max:8|unique:students',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
            'name_en' => 'required',
            'name_ar' => 'required',
            'email' => 'required|email|unique:students',
            'date_of_birth' => 'required|date',
            'nationality_id' => 'required|exists:nationalities,id',
            'education_level_id' => 'required|exists:nationalities,id',
            'address' => 'required',
            'reference' => 'required'
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
            ],
            'password_confirmation' => [
                'example' => '12345678',
            ],
            'name_en' => [
                'example' => 'John Snow',
            ],
            'name_ar' => [
                'example' => 'حون سنو'
            ],
            'email' => [
                'example' => 'john.snow@mail.com'
            ],
            'date_of_birth' => [
                'example' => '1998-01-01'
            ],
            'nationality_id' => [
                'example' => '1'
            ],
            'education_level_id' => [
                'example' => '1'
            ],
            'address' => [
                'example' => 'New York'
            ],
            'reference' => [
                'example' => 'Facebook'
            ],
        ];
    }
}
