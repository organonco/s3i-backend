<?php

namespace App\Models\BaseModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class BaseUser extends User
{
    use HasFactory, Notifiable, HashableId;
}
