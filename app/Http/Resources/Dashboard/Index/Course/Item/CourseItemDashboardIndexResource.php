<?php

namespace App\Http\Resources\Dashboard\Index\Course\Item;

use App\Http\Resources\Base\Course\Items\CourseItemResource;
use App\Http\Resources\Dashboard\Index\Course\Item\Quiz\CourseQuizDashboardIndexResource;
use App\Interfaces\HasCourseItemInterface;
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
            \App\Models\CourseVideo::class => CourseVideoDashboardIndexResource::class,
            \App\Models\CourseSection::class => CourseSectionDashboardIndexResource::class,
            \App\Models\CourseMeeting::class => CourseMeetingDashboardIndexResource::class,
            \App\Models\CourseHomework::class => CourseHomeworkDashboardIndexResource::class,
            \App\Models\CourseFile::class => CourseFileDashboardIndexResource::class,
            \App\Models\CourseQuiz::class => CourseQuizDashboardIndexResource::class,
        })::make($item);
    }
}
