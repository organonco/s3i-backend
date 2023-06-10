<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

class CoursePolicy
{

    public function viewDetails(Student $user, $courseId): bool
    {
        return in_array($courseId, $user->courses->pluck('id')->toArray());
    }

    public function supervise(User $user, $courseId): bool
    {
        return false;
    }

    public function edit(User $user, $courseId)
    {
        return true;
    }
}
