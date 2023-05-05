<?php

namespace App\Http\Resources\Base\Course\Items;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseSectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
        ];
    }
}