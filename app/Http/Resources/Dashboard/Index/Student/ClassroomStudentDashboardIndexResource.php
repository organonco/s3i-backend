<?php

namespace App\Http\Resources\Dashboard\Index\Student;

use App\Http\Resources\Base\Student\StudentResource;
use Illuminate\Http\Request;

class ClassroomStudentDashboardIndexResource extends StudentDashboardIndexResource
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
        unset($base['number_of_login_attempts']);
        unset($base['is_verified']);
        unset($base['phone']);
        return $base;
    }
}