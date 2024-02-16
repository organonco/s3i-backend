<?php

namespace App\Http\Resources\Base\Course\Items\Quiz;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseQuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'time_limit' => $this->time_limit,
            'is_limited' => $this->is_limited,
            'questions' => CourseQuizQuestionResource::collection($this->whenLoaded('questions'))
        ];
    }
}
