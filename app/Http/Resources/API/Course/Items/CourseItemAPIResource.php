<?php

namespace App\Http\Resources\API\Course\Items;

use App\Http\Resources\API\Course\Items\Quiz\CourseQuizAPIResource;
use App\Http\Resources\Base\Course\Items\CourseItemResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\CourseFile;
use App\Models\CourseHomework;
use App\Models\CourseMeeting;
use App\Models\CourseQuiz;
use App\Models\CourseSection;
use App\Models\CourseVideo;
use Illuminate\Http\Request;

class CourseItemAPIResource extends CourseItemResource
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
            CourseVideo::class => CourseVideoAPIResource::class,
            CourseSection::class => CourseSectionAPIResource::class,
            CourseMeeting::class => CourseMeetingAPIResource::class,
            CourseHomework::class => CourseHomeworkAPIResource::class,
            CourseFile::class => CourseFileAPIResource::class,
            CourseQuiz::class => CourseQuizAPIResource::class,
        })::make($item);
    }
}
