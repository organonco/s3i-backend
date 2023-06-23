<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Dashboard\Index\Course\ClassroomDashboardIndexResource;
use Inertia\Inertia;

class ClassroomController extends Controller
{
    public function index()
    {
        $user = $this->getAuthenticatedUser();
        return Inertia::render('Classroom/Index', [
            "classrooms" => ClassroomDashboardIndexResource::collection($user->classrooms),
        ]);
    }
}
