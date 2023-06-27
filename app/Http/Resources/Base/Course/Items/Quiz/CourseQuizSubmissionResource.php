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
            'id' => $this->hash,
            'student_name' => $this->student->name_ar,
            'quiz_id' => $this->courseQuiz->hash,
            'quiz_name' => $this->courseQuiz->name,
        ];
    }
}
