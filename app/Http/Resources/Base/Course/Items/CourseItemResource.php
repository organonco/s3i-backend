<?php

namespace App\Http\Resources\Base\Course\Items;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizResource;
use App\Interfaces\HasCourseItemInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->hash,
            'type' => $this->type,
            'object' => $this->getCourseItemObjectResource($this->item),
        ];
    }

    private function getCourseItemObjectResource(HasCourseItemInterface $item)
    {
        return (match (get_class($item)) {
            \App\Models\CourseVideo::class => CourseVideoResource::class,
            \App\Models\CourseSection::class => CourseSectionResource::class,
            \App\Models\CourseMeeting::class => CourseMeetingResource::class,
            \App\Models\CourseHomework::class => CourseHomeworkResource::class,
            \App\Models\CourseFile::class => CourseFileResource::class,
            \App\Models\CourseQuiz::class => CourseQuizResource::class,
        })::make($item);
    }
}
