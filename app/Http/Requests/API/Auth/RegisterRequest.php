<?php

namespace App\Http\Requests\API\Auth;

use App\Http\Requests\API\Request;
use App\Models\EducationLevel;
use App\Models\Nationality;
use Veelasky\LaravelHashId\Rules\ExistsByHash;

class RegisterRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(), [
            'nationality_id' => Nationality::hashToId($this->input('nationality_id')),
            'education_level_id' => EducationLevel::hashToId($this->input('education_level_id'))
        ]);
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|min:8|max:8|unique:students',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
            'name_en' => 'required',
            'name_ar' => 'required',
            'email' => 'required|email|unique:students',
            'date_of_birth' => 'required|date',
            'nationality_id' => ['required', new ExistsByHash(Nationality::class)],
            'education_level_id' => ['required', new ExistsByHash(EducationLevel::class)],
            'address' => 'required',
            'reference' => 'nullable',
            'gender' => 'required'
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
                'example' => Nationality::first()->hash,
            ],
            'education_level_id' => [
                'example' => EducationLevel::first()->hash,
            ],
            'address' => [
                'example' => 'New York'
            ],
            'reference' => [
                'example' => 'Facebook'
            ],
            'gender' => [
                'example' => '1'
            ],
        ];
    }
}
