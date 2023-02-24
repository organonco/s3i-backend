<?php

namespace App\Models;

use App\Models\BaseModels\BaseUser;
use Laravel\Sanctum\HasApiTokens;

class Student extends BaseUser
{
    use HasApiTokens;
}
