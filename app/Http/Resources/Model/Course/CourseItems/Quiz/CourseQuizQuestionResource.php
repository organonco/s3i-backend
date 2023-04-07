<?php

namespace App\Http\Resources\Model\Course\CourseItems\Quiz;

use App\Enums\CourseQuizQuestionTypes;
use App\Http\Resources\Model\Course\CourseItems\Quiz\Option\CourseQuizQuestionOptionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseQuizQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource = [
            'type' => $this->type,
            'object' => [
                'text' => $this->text,
            ],
        ];
        if($this->type != CourseQuizQuestionTypes::TEXT)
            $resource['object']['options'] = CourseQuizQuestionOptionResource::collection($this->options);
        return $resource;
    }
}
