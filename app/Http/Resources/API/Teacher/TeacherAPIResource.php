<?php

namespace App\Http\Resources\API\Teacher;

use App\Http\Resources\Base\Student\EducationLevelResource;
use App\Http\Resources\Base\Student\NationalityResource;
use App\Http\Resources\Base\Student\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherAPIResource extends StudentResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['username']);
        unset($base['visible']);
        return $base;
    }

}
