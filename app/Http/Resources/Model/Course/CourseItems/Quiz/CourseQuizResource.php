<?php

namespace App\Http\Resources\Model\Course\CourseItems\Quiz;

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
            'questions' => CourseQuizQuestionResource::collection($this->questions)
        ];
    }
}