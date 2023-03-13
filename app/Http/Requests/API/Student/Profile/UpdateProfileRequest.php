<?php

namespace App\Http\Requests\API\Student\Profile;

use App\Http\Requests\API\Request;
use App\Models\EducationLevel;
use App\Models\Nationality;
use Veelasky\LaravelHashId\Rules\ExistsByHash;

class UpdateProfileRequest extends Request
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

    public function rules() : array
    {
        return [
            'name_en' => 'required',
            'name_ar' => 'required',
            'date_of_birth' => 'required|date',
            'nationality_id' =>  ['required', new ExistsByHash(Nationality::class)],
            'education_level_id' =>  ['required', new ExistsByHash(EducationLevel::class)],
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
                'example' => 'VjKYd4ZL'
            ],
            'education_level_id' => [
                'example' => 'VjKYd4ZL'
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
