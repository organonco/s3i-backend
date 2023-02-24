<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'phone' => $this->phone,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'address' => $this->address,
            'reference' => $this->reference,
            'education_level' => $this->educationLevel->name,
            'nationality' => $this->nationality->name,
        ];
    }
}
