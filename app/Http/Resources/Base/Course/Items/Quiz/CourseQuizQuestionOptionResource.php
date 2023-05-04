<?php

namespace App\Http\Resources\Base\Course\Items\Quiz;

use App\Http\Resources\Model\Course\CourseItems\Quiz\Option\CourseQuizQuestionOptionAPIResource;
use Illuminate\Http\Request;

class CourseQuizQuestionOptionResource extends CourseQuizQuestionOptionAPIResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'text' => $this->text,
            'is_correct' => $this->is_correct
        ];
    }
}
