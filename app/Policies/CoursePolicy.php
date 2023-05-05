<?php

namespace App\Policies;

use App\Models\Student;

class CoursePolicy
{

    public function viewDetails(Student $user, $courseId): bool
    {
        return in_array($courseId, $user->courses->pluck('id')->toArray());
    }
}
