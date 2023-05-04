<?php

namespace App\Http\Resources\Base\Course\Items;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseMeetingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'time' => $this->time,
            'date' => $this->date
        ];
    }
}
