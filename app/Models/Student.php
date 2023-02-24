<?php

namespace App\Models;

use App\Models\BaseModels\BaseUser;
use Laravel\Sanctum\HasApiTokens;

class Student extends BaseUser
{
    use HasApiTokens;
    public $fillable = ['phone', 'password', 'name_ar', 'name_en', 'email', 'date_of_birth', 'nationality_id', 'education_level_id', 'address', 'reference'];
}
