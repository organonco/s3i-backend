<?php

namespace App\Http\Resources\Dashboard\Show\Student;

use App\Http\Resources\Base\Student\StudentResource;
use Illuminate\Http\Request;

class StudentDashboardShowResource extends StudentResource
{
    public function toArray(Request $request): array
    {
        $this->load('nationality');
        $this->load('educationLevel');
        $base = parent::toArray($request);
        $base['nationality'] = $base['nationality']['name'];
        $base['education_level'] = $base['education_level']['name'];
        return $base;
    }
}
