<?php

namespace App\Http\Resources\Dashboard\Show\Course\Item\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizQuestionOptionResource;
use Illuminate\Http\Request;

class CourseQuizQuestionOptionDashboardShowResource extends CourseQuizQuestionOptionResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        return [
            'type' => 'option',
            'id' => $base['id'],
            'object' => $base
        ];
    }
}
