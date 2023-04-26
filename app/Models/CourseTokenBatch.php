<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;

class CourseTokenBatch extends BaseModel
{
    use HasTags;

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
