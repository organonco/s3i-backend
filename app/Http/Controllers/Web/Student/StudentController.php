<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Model\Student\StudentBaseResource;
use App\Http\Resources\Model\Student\StudentIndexResource;
use App\Models\Student;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Student/Index', [
            'students' => StudentIndexResource::collection(Student::all())
        ]);
    }

    public function show(Student $student)
    {
        return Inertia::render('Student/Show', [
            'student' => StudentBaseResource::make($student)
        ]);
    }

    public function unfreeze(Student $student)
    {
        $student->resetNumberOfLoginAttempts();
        return redirect()->route('student.show', ['student' => $student->hash]);
    }
}
