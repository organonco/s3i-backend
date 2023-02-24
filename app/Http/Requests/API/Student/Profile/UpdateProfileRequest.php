<?php

namespace App\Http\Requests\API\Student\Profile;

use App\Http\Requests\API\Request;

class UpdateProfileRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name_en' => 'required',
            'name_ar' => 'required',
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
            'name_en' => [
                'example' => 'John Snow',
            ],
            'name_ar' => [
                'example' => 'حون سنو'
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
