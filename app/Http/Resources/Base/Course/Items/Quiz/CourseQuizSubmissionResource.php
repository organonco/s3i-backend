<?php

namespace App\Http\Resources\Base\Course\Items\Quiz;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseQuizSubmissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'has_feedback' => $this->has_feedback,
            'feedback' => $this->feedback,
        ];
    }
}
