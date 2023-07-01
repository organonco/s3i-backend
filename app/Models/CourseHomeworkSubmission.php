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

    public function scopeStudents($query, $student_ids)
    {
        return $query->whereIn('student_id', $student_ids);
    }

    public function scopeHomeworks($query, $homework_ids)
    {
        return $query->whereIn('course_homework_id', $homework_ids);
    }

    public function courseHomework()
    {
        return $this->belongsTo(CourseHomework::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
