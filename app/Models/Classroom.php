<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

class Classroom extends BaseModel
{
    protected $fillable = ['name'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function isFull()
    {
        return $this->students()->count() >= $this->course->students_limit;
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
