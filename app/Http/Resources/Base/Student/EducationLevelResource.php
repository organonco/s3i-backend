<?php

namespace App\Http\Resources\Base\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationLevelResource extends JsonResource
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
            'name' => $this->name,
        ];
    }
}
