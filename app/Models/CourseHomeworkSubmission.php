<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CourseHomeworkSubmission extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['student_id', 'course_homework_id', 'feedback'];

    public function getFileUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('file');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('file')
            ->singleFile();
    }

    public function scopeByStudent($query, $student_id)
    {
        return $query->where('student_id', $student_id);
    }
}
