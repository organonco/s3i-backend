<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Base\Student\StudentResource;
use App\Http\Resources\Dashboard\Index\Student\StudentDashboardIndexResource;
use App\Http\Resources\Dashboard\Show\Student\StudentDashboardShowResource;
use App\Models\Student;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Student/Index', [
            'students' => StudentDashboardIndexResource::collection(Student::all())
        ]);
    }

    public function show(Student $student)
    {
        return Inertia::render('Student/Show', [
            'student' => StudentDashboardShowResource::make($student)
        ]);
    }

    public function unfreeze(Student $student)
    {
        $student->resetNumberOfLoginAttempts();
        return redirect()->route('student.show', ['student' => $student->hash]);
    }
}
