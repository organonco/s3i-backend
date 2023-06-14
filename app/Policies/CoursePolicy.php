<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    public function view(Student $user, $courseId): bool
    {
        return in_array($courseId, $user->courses->pluck('id')->toArray());
    }
}
