<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

/**
 * @property $number_of_students
 */
class Classroom extends BaseModel
{
    protected $fillable = ['name'];

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function isFull()
    {
        return $this->number_of_students >= $this->course->students_limit;
    }

    public function getNumberOfStudentsAttribute()
    {
        return $this->students()->count();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
