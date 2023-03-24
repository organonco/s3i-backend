<?php

namespace App\Models;

use App\Http\Resources\Model\Course\CourseItems\CourseVideoResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\BaseModels\BaseModel;
use App\Traits\HasCourseItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseVideo extends BaseModel implements HasCourseItemInterface
{
    use HasCourseItem;

    protected $fillable = ['name', 'url'];

    public function getResourceClass(): string
    {
        return CourseVideoResource::class;
    }
}
