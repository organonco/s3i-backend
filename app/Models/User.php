<?php

namespace App\Models;

use App\Models\BaseModels\BaseUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


/**
 * @property string $name
 * @property string $hash
 * @property string $username
 * @property bool $super_admin
 * @property string $bio
 * @property string $education
 */
class User extends BaseUser implements HasMedia
{
    
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'username',
        'password',
        'super_admin',
        'bio',
        'education',
        'visible'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->super_admin;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function getClassroomsAttribute()
    {
        return $this->courses()->with('classrooms')->get()->pluck('classrooms')->flatten(1);
    }

    public function scopeTeachers(Builder $builder): Builder
    {
        return $builder->where('super_admin', false);
    }

    public function scopeVisible(Builder $builder): Builder
    {
        return $builder->where('visible', true);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value,
            set: fn(string $value) => Hash::make($value),
        );
    }

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
}
