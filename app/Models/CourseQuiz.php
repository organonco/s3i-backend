<?php

namespace App\Models;

use App\Http\Resources\Model\Course\CourseItems\Quiz\CourseQuizAPIResource;
use App\Http\Resources\Model\Course\CourseItems\Quiz\CourseQuizResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\BaseModels\BaseModel;
use App\Traits\HasCourseItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseQuiz extends BaseModel implements HasCourseItemInterface
{
    use HasCourseItem;
    protected $fillable = ['name'];

    public static function create(array $attributes = [])
    {
        /** @var self $model */
        $model = static::query()->create($attributes);
        foreach($attributes['questions']  as $index => $question)
            CourseQuizQuestion::createOrUpdateFromDataObject($question, $index, $model->id);
        return $model;
    }

    public function update(array $attributes = [], $options = [])
    {
        parent::update($attributes, $options);
        $remainingIds = collect($attributes['questions'])->whereNotNull('id')->pluck(['id'])->transform(function($hash){
            return CourseItem::hashToId($hash);
        });
        $this->questions()->whereNotIn('id', $remainingIds)->delete();
        foreach($attributes['questions'] as $index => $question)
            CourseQuizQuestion::createOrUpdateFromDataObject($question, $index, $this->id);
    }

    public function getResourceClass(): string
    {
        return CourseQuizResource::class;
    }

    public function getAPIResourceClass(): string
    {
        return CourseQuizAPIResource::class;
    }

    public function questions() : HasMany
    {
        return $this->hasMany(CourseQuizQuestion::class);
    }
}
