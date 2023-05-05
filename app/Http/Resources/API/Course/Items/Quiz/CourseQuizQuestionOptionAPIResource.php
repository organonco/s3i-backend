<?php

namespace App\Http\Resources\API\Course\Items\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizQuestionOptionResource;
use Illuminate\Http\Request;

class CourseQuizQuestionOptionAPIResource extends CourseQuizQuestionOptionResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        unset($base['is_correct']);
        return $base;
    }
}
