<?php

namespace App\Http\Resources\Model\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseBaseResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'introduction_video_url' => $this->introduction_video_url,
            'category_id' => $this->category->hash,
            'image_url' => $this->image_url,
        ];
    }
}
