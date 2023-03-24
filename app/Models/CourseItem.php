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
    public static function createFromDataObject($dataObject, $order, $courseId) : self
    {
        $createdCourseItem = null;
        if($dataObject['type'] == 'section')
            $createdCourseItem = CourseSection::create(['name' => $dataObject['object']['name']]);
        return $createdCourseItem->courseItem()->create(['course_id' => $courseId, 'order' => $order]);
    }
}
