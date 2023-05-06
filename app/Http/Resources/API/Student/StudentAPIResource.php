<?php

namespace App\Http\Resources\API\Student;

use App\Http\Resources\Base\Student\EducationLevelResource;
use App\Http\Resources\Base\Student\NationalityResource;
use App\Http\Resources\Base\Student\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentAPIResource extends StudentResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['number_of_login_attempts']);
        unset($base['is_verified']);
        return $base;
    }

}
