<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

class CourseTokenBatch extends BaseModel
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function tokens()
    {
        return $this->hasMany(CourseToken::class);
    }
}
