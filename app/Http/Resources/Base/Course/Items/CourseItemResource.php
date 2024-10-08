<?php

namespace App\Http\Resources\Base\Course\Items;

use App\Http\Resources\Base\Course\Items\Quiz\CourseQuizResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\CourseFile;
use App\Models\CourseHomework;
use App\Models\CourseMeeting;
use App\Models\CourseQuiz;
use App\Models\CourseSection;
use App\Models\CourseVideo;
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
            CourseVideo::class => CourseVideoResource::class,
            CourseSection::class => CourseSectionResource::class,
            CourseMeeting::class => CourseMeetingResource::class,
            CourseHomework::class => CourseHomeworkResource::class,
            CourseFile::class => CourseFileResource::class,
            CourseQuiz::class => CourseQuizResource::class,
        })::make($item);
    }
}
