<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'description', 'introduction_video_url', 'category_id', 'students_limit'];

    public function getImageUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('image');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function courseItems()
    {
        return $this->hasMany(CourseItem::class);
    }

    public function getStudentsAttribute()
    {
        $collection = collect([]);
        foreach ($this->classrooms as $classroom)
            $collection = $collection->merge($classroom->students);
        return $collection;
    }

    public function addStudent(Student $student)
    {
        if ($this->students->pluck('id')->contains($student->id))
            return;

        /** @var Classroom $latestClassroom */
        $classroom = $this->classrooms()->orderBy('id', 'desc')->first();
        if (is_null($classroom) || $classroom->isFull())
            $classroom = $this->addClassroom();
        $classroom->students()->syncWithoutDetaching([$student->id]);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    private function addClassroom(): Classroom
    {
        return $this->classrooms()->create(['name' => $this->name . " - " . $this->classrooms()->count() + 1]);
    }
}
