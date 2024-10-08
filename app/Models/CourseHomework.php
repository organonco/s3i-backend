<?php

namespace App\Models;

use App\Http\Resources\Base\Course\Items\CourseHomeworkResource;
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

    public function courseHomeworkSubmissions()
    {
        return $this->hasMany(CourseHomeworkSubmission::class);
    }
}
