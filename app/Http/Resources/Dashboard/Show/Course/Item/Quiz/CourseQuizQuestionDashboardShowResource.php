<?php

namespace App\Http\Resources\Dashboard\Show\Course\Item\Quiz;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizQuestionResource;
use Illuminate\Http\Request;

class CourseQuizQuestionDashboardShowResource extends CourseQuizQuestionResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['object'] = [
            'text' => $base['text']
        ];
        $base['options'] = CourseQuizQuestionOptionDashboardShowResource::collection($this->whenLoaded('options'));
        unset($base['text']);
        return $base;
    }
}
