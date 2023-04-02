<?php

namespace App\Http\Resources\Model\Course\CourseItems\Quiz\Option;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseQuizQuestionOptionShowResource extends CourseQuizQuestionOptionBaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['is_correct'] = $this->is_correct;
        return $base;
    }
}
