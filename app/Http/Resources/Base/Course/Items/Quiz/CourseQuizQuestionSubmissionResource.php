<?php

namespace App\Http\Resources\Base\Course\Items\Quiz;

use App\Http\Resources\Dashboard\Show\Course\Item\Quiz\CourseQuizQuestionDashboardShowResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseQuizQuestionSubmissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->hash,
            'quiz_question' => CourseQuizQuestionDashboardShowResource::make($this->courseQuizQuestion),
            'answer' => json_decode($this->answer),
        ];
    }
}
