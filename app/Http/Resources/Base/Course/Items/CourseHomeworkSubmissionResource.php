<?php

namespace App\Http\Resources\Base\Course\Items;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseHomeworkSubmissionResource extends JsonResource
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
            'homework_id' => $this->courseHomework->hash,
            'homework_name' => $this->courseHomework->name,
            'has_feedback' => !is_null($this->feedback),
            'feedback' => $this->feedback,
            'file_url' => $this->file_url,
        ];
    }
}
