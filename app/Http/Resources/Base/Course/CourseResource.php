<?php

namespace App\Http\Resources\Base\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'students_limit' => $this->students_limit,
            'image_url' => $this->image_url,
            'category' => CategoryResource::make($this->category),
            'price' => $this->price
        ];
    }
}
