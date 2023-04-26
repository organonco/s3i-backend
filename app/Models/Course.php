<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'description', 'introduction_video_url', 'category_id', 'students_limit'];

    public function getImageUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('image');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function courseItems()
    {
        return $this->hasMany(CourseItem::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
