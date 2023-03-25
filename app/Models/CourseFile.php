<?php

namespace App\Models;

use App\Http\Resources\Model\Course\CourseItems\CourseFileResource;
use App\Interfaces\HasCourseItemInterface;
use App\Models\BaseModels\BaseModel;
use App\Traits\HasCourseItem;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CourseFile extends BaseModel implements HasCourseItemInterface, HasMedia
{
    use HasCourseItem, InteractsWithMedia;
    protected $fillable = ['name'];
    public function getResourceClass(): string
    {
        return CourseFileResource::class;
    }

    public function getFileUrlAttribute() : string
    {
        return $this->getFirstMediaUrl('file');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('file')
            ->singleFile();
    }

}
