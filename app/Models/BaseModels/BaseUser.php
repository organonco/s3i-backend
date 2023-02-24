<?php

namespace App\Models\BaseModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class BaseUser extends User
{
    use HasFactory, Notifiable;
}
