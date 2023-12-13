<?php

namespace App\Models;

use App\Models\BaseModels\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $fillable = ['name'];
    protected $cascadeDeletes = ['courses'];


    public function getIconUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('icon');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('icon')
            ->singleFile();
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
