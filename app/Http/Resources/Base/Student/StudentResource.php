<?php

namespace App\Http\Resources\Base\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->hash,
            'phone' => $this->full_phone_number,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'gender' => trans('constants.gender.' . $this->gender),
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
            'reference' => $this->reference,
            'number_of_login_attempts' => $this->number_of_login_attempts,
            'education_level' => EducationLevelResource::make($this->whenLoaded('educationLevel')),
            'nationality' => NationalityResource::make($this->whenLoaded('nationality')),
            'is_verified' => $this->is_verified,
            'created_at' => date('d/m/Y', strtotime($this->created_at))
        ];
    }
}
