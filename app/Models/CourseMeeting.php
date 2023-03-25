<?php

namespace App\Models;

use App\Http\Resources\Model\Course\CourseItems\CourseMeetingResource;
use App\Http\Resources\Model\Course\CourseItems\CourseVideoResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\BaseModels\BaseModel;
use App\Traits\HasCourseItem;

class CourseMeeting extends BaseModel implements HasCourseItemInterface
{
    use HasCourseItem;
    protected $fillable = ['name', 'url', 'time', 'date'];
    public function getResourceClass(): string
    {
        return CourseMeetingResource::class;
    }
}
