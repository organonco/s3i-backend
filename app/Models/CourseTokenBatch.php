<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

class CourseTokenBatch extends BaseModel
{
    public $fillable = ['expires_at'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
    public function tokens()
    {
        return $this->hasMany(CourseToken::class);
    }
}
