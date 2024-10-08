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
            'text' => $base['text'],
            'type' => $base['type'],
            'options' => CourseQuizQuestionOptionDashboardShowResource::collection($this->options)
        ];
        $base['type'] = $this->quiz->type;
        unset($base['text']);
        unset($base['options']);
        return $base;
    }
}
