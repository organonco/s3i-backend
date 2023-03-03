<?php

namespace App\Http\Resources\API;

use App\Http\Resources\Model\EducationLevelResource;
use App\Http\Resources\Model\NationalityResource;
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
            'education_levels' => EducationLevelResource::collection(EducationLevel::all()),
            'nationalities' => NationalityResource::collection(Nationality::all()),
        ];
    }
}
