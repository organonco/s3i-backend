<?php

namespace App\Models;

use App\Models\BaseModels\BaseUser;
use Laravel\Sanctum\HasApiTokens;

class User extends BaseUser
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
