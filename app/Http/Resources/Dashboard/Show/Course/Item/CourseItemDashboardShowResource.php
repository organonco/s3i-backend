<?php

namespace App\Http\Resources\Dashboard\Show\Course\Item;

use App\Http\Resources\Base\Course\Items\CourseItemResource;
use App\Http\Resources\Dashboard\Show\Course\Item\Quiz\CourseQuizDashboardShowResource;
use App\Interfaces\HasCourseItemInterface;
use Illuminate\Http\Request;

class CourseItemDashboardShowResource extends CourseItemResource
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
            \App\Models\CourseVideo::class => CourseVideoDashboardShowResource::class,
            \App\Models\CourseSection::class => CourseSectionDashboardShowResource::class,
            \App\Models\CourseMeeting::class => CourseMeetingDashboardShowResource::class,
            \App\Models\CourseHomework::class => CourseHomeworkDashboardShowResource::class,
            \App\Models\CourseFile::class => CourseFileDashboardShowResource::class,
            \App\Models\CourseQuiz::class => CourseQuizDashboardShowResource::class,
        })::make($item);
    }
}
