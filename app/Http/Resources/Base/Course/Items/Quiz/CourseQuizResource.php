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
            'name' => $this->name,
            'type' => $this->type,
            'questions' => CourseQuizQuestionResource::collection($this->whenLoaded('questions'))
        ];
    }
}