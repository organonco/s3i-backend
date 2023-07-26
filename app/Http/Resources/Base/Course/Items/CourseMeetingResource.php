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
            'id' => $this->hash,
            'classroom_meeting' => $this->whenNotNull(ClassroomMeetingResource::make($this->classroomMeeting)),
            'is_set' => !is_null($this->classroomMeeting),
        ];
    }
}
