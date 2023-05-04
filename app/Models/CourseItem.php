<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Builder;

class CourseItem extends BaseModel
{
    protected $fillable = ['order', 'item_id', 'item_type', 'course_id'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    public static function createOrUpdateFromDataObject($dataObject, $order, $courseId): self
    {
        if (isset($dataObject['id'])) {
            $courseItem = self::byHash($dataObject['id']);
            $courseItem->item->update($dataObject['object']);
            $courseItem->update(['order' => $order]);
        } else {
            $courseItemDetails = self::typeToClass($dataObject['type'])::create($dataObject['object']);
            $courseItem = $courseItemDetails->courseItem()->create(['course_id' => $courseId, 'order' => $order]);
        }
        return $courseItem;
    }

    private static function typeToClass(string $type): string
    {
        return match ($type) {
            'section' => CourseSection::class,
            'video' => CourseVideo::class,
            'meeting' => CourseMeeting::class,
            'file' => CourseFile::class,
            'homework' => CourseHomework::class,
            'quiz' => CourseQuiz::class,
        };
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function item()
    {
        return $this->morphTo('item');
    }

    public function getTypeAttribute()
    {
        return $this->classToType($this->item::class);
    }

    private static function classToType(string $className): string
    {
        return match ($className) {
            CourseSection::class => 'section',
            CourseVideo::class => 'video',
            CourseMeeting::class => 'meeting',
            CourseFile::class => 'file',
            CourseHomework::class => 'homework',
            CourseQuiz::class => 'quiz',
        };
    }
}
