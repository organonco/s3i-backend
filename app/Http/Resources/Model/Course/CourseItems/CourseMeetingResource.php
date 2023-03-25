<?php

namespace App\Http\Resources\Model\Course\CourseItems;

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
