<?php

namespace App\Http\Resources\Base\Course\Items;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomMeetingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->date,
            'time' => $this->time,
            'url' => $this->url,
        ];
    }
}
