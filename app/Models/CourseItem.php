<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;

class CourseItem extends BaseModel
{
    protected $fillable = ['order', 'item_id', 'item_type', 'course_id'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function item()
    {
        return $this->morphTo('item');
    }
}
