<?php

namespace App\Models;

use App\Interfaces\HasCourseItemInterface;
use App\Models\BaseModels\BaseModel;
use App\Traits\HasCourseItem;

class CourseSection extends BaseModel implements HasCourseItemInterface
{
    use HasCourseItem;
    protected $fillable = ['name'];
}
