<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

class Classroom extends BaseModel
{
    public function coures()
    {
        return $this->hasOne(Course::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
