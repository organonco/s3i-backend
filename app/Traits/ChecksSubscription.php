<?php

namespace App\Traits;

use App\Models\Course;
use App\Models\Student;

trait ChecksSubscription
{
    public function isSubscribedToCourse($courseId): bool
    {
        return auth('sanctum')->check() && auth('sanctum')->user()->can('viewDetails', [Course::class, $courseId]);
    }
    public function getAuthenticatedStudent(): Student
    {
        /** @var Student $student */
        $student = auth('sanctum')->user();
        return $student;
    }
}
