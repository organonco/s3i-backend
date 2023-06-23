<?php

namespace App\Models;

use App\Models\BaseModels\BaseUser;

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

    public function scopeTeachers($query)
    {
        return $query->where('super_admin', false);
    }
}
