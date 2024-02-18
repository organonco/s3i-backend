<?php

namespace App\Http\Resources\Dashboard\Show\Course\Item;

use App\Http\Resources\Base\Course\Items\CourseItemResource;
use App\Http\Resources\Dashboard\Show\Course\Item\Quiz\CourseQuizDashboardShowResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\CourseFile;
use App\Models\CourseHomework;
use App\Models\CourseMeeting;
use App\Models\CourseQuiz;
use App\Models\CourseSection;
use App\Models\CourseVideo;
use Illuminate\Http\Request;

class CourseItemDashboardShowResource extends CourseItemResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);
        $base['object'] = array_merge($this->getCourseItemObjectResource($this->item)->toArray($request), ['description' => $this->description]);
        return $base;
    }

    private function getCourseItemObjectResource(HasCourseItemInterface $item)
    {
        return (match (get_class($item)) {
            CourseVideo::class => CourseVideoDashboardShowResource::class,
            CourseSection::class => CourseSectionDashboardShowResource::class,
            CourseMeeting::class => CourseMeetingDashboardShowResource::class,
            CourseHomework::class => CourseHomeworkDashboardShowResource::class,
            CourseFile::class => CourseFileDashboardShowResource::class,
            CourseQuiz::class => CourseQuizDashboardShowResource::class,
        })::make($item);
    }
}
