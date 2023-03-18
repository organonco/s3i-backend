<?php

namespace App\Http\Resources\Model\Student;

use Illuminate\Http\Request;

class StudentIndexResource extends StudentBaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['name_en']);
        unset($base['email']);
        unset($base['date_of_birth']);
        unset($base['address']);
        unset($base['reference']);
        unset($base['nationality']);
        unset($base['education_level']);
        return $base;
    }
}
