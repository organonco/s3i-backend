<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Dashboard\Index\Course\ClassroomDashboardIndexResource;
use App\Http\Resources\Dashboard\Index\Course\Item\Quiz\CourseHomeworkSubmissionDashboardIndexResource;
use App\Http\Resources\Dashboard\Index\Course\Item\Quiz\CourseQuizSubmissionDashboardIndexResource;
use App\Http\Resources\Dashboard\Index\Student\ClassroomStudentDashboardIndexResource;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\CourseQuiz;
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

    public function getStudents(string $hash)
    {
        $classroom = Classroom::byHashOrFail($hash);
        return ClassroomStudentDashboardIndexResource::collection($classroom->students);
    }


    public function getQuizzes(string $hash)
    {
        /** @var Classroom $classroom */
        $classroom = Classroom::byHashOrFail($hash);
        /** @var Course $course */
        $course = $classroom->course;
        $quizzes = $course->getQuizzes();
        $submissions = collect();
        /** @var CourseQuiz $quiz */
        foreach ($quizzes as $quiz)
            $submissions = $submissions->merge($quiz->quizSubmissions);

        return CourseQuizSubmissionDashboardIndexResource::collection($submissions);
    }

    public function getHomeworks(string $hash)
    {
        /** @var Classroom $classroom */
        $classroom = Classroom::byHashOrFail($hash);
        /** @var Course $course */
        $course = $classroom->course;
        $homeworks = $course->getHomeworks();
        $submissions = collect();
        /** @var CourseQuiz $quiz */
        foreach ($homeworks as $homework)
            $submissions = $submissions->merge($homework->courseHomeworkSubmissions);

        return CourseHomeworkSubmissionDashboardIndexResource::collection($submissions);
    }
}
