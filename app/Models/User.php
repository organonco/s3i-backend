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
}
