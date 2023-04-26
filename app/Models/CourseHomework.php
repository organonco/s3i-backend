<?php

namespace App\Models;

use App\Http\Resources\Model\Course\CourseItems\CourseHomeworkResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\BaseModels\BaseModel;
use App\Traits\HasCourseItem;

class CourseHomework extends BaseModel implements HasCourseItemInterface
{
    use HasCourseItem;

    protected $fillable = ['name'];

    public function getResourceClass(): string
    {
        return CourseHomeworkResource::class;
    }
}
