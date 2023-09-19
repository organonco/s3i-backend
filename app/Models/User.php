<?php

namespace App\Models;

use App\Models\BaseModels\BaseUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;


/**
 * @property string $name
 * @property string $hash
 * @property string $username
 * @property bool $super_admin
 */
class User extends BaseUser
{
    protected $fillable = [
        'name',
        'username',
        'password',
        'super_admin'
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

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value,
            set: fn(string $value) => Hash::make($value),
        );
    }
}
