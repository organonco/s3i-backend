<?php

namespace App\Models;

use App\Http\Resources\Model\Course\CourseItems\Quiz\CourseQuizResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\BaseModels\BaseModel;
use App\Traits\HasCourseItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseQuiz extends BaseModel implements HasCourseItemInterface
{
    use HasCourseItem;
    protected $fillable = ['name'];

    public function getResourceClass(): string
    {
        return CourseQuizResource::class;
    }

    public function questions() : HasMany
    {
        return $this->hasMany(CourseQuizQuestion::class);
    }
}
