<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['name', 'description', 'introduction_video_url', 'category_id'];
    public function getImageUrlAttribute() : string
    {
        return $this->getFirstMediaUrl('image');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();
    }

}
