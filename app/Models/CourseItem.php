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
    public static function createOrUpdateFromDataObject($dataObject, $order, $courseId) : self
    {
        if(!isset($dataObject['id'])) {
            $courseItemDetails = null;
            if ($dataObject['type'] == 'section')
                $courseItemDetails = CourseSection::create($dataObject['object']);
            return $courseItemDetails->courseItem()->create(['course_id' => $courseId, 'order' => $order]);
        }
        $courseItem = CourseItem::byHash($dataObject['id']);
        $courseItem->update(['order' => $order]);
        $courseItem->item->update($dataObject['object']);
        return $courseItem;
    }
}
