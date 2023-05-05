<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Student;

class Controller extends BaseController
{
    public function getAuthenticatedStudent() : Student
    {
        return auth('sanctum')->user();
    }
}
