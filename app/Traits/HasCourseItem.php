<?php

namespace App\Traits;

use App\Models\Course;
use App\Models\CourseItem;

trait HasCourseItem
{
    public function courseItem()
    {
        return $this->morphOne(CourseItem::class, 'item');
    }

    public function getCourseIdAttribute()
    {
        return $this->courseItem->course_id;
    }

    public function course()
    {
        return $this->hasOneThrough(Course::class, CourseItem::class);
    }

    public function getAPIResourceClass(): string
    {
        return $this->getResourceClass();
    }
}
