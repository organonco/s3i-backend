<?php

namespace App\Http\Resources\Model\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentBaseResource extends JsonResource
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
            'phone' => $this->phone,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
            'reference' => $this->reference,
            'education_level' => $this->educationLevel->name,
            'nationality' => $this->nationality->name,
            'number_of_login_attempts' => $this->number_of_login_attempts,
        ];
    }
}
