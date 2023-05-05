<?php

namespace App\Http\Resources\API;

use App\Http\Resources\Base\Student\NationalityResource;
use App\Http\Resources\Dashboard\Index\Student\EducationLevelDashboardIndexResource;
use App\Models\EducationLevel;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'education_levels' => EducationLevelDashboardIndexResource::collection(EducationLevel::all()),
            'nationalities' => NationalityResource::collection(Nationality::all()),
        ];
    }
}
