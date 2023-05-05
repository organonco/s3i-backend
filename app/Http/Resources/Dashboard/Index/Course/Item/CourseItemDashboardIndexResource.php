<?php

namespace App\Http\Resources\Dashboard\Index\Course\Item;

use App\Http\Resources\Base\Course\Items\CourseItemResource;
use App\Http\Resources\Dashboard\Index\Course\Item\Quiz\CourseQuizDashboardIndexResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\CourseFile;
use App\Models\CourseHomework;
use App\Models\CourseMeeting;
use App\Models\CourseQuiz;
use App\Models\CourseSection;
use App\Models\CourseVideo;
use Illuminate\Http\Request;

class CourseItemDashboardIndexResource extends CourseItemResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['object'] = $this->getCourseItemObjectResource($this->item);
        return $base;
    }

    private function getCourseItemObjectResource(HasCourseItemInterface $item)
    {
        return (match (get_class($item)) {
            CourseVideo::class => CourseVideoDashboardIndexResource::class,
            CourseSection::class => CourseSectionDashboardIndexResource::class,
            CourseMeeting::class => CourseMeetingDashboardIndexResource::class,
            CourseHomework::class => CourseHomeworkDashboardIndexResource::class,
            CourseFile::class => CourseFileDashboardIndexResource::class,
            CourseQuiz::class => CourseQuizDashboardIndexResource::class,
        })::make($item);
    }
}
