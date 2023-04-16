<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\IndexCoursesRequest;
use App\Http\Requests\API\Course\ShowCourseRequest;
use App\Http\Requests\API\Course\ShowQuizRequest;
use App\Http\Resources\Model\Course\CourseIndexResource;
use App\Http\Resources\Model\Course\CourseItems\Quiz\CourseQuizAPIResource;
use App\Http\Resources\Model\Course\CourseShowAPIResource;
use App\Models\Course;
use App\Models\CourseQuiz;

/**
 * @group Course
 * @subgroup Quiz
 */
class QuizController extends Controller
{

    /**
     * Show
     * @responseFile app/Http/Responses/Samples/Quiz/show.json
     */
    public function show(CourseQuiz $quiz, ShowQuizRequest $request)
    {
        return new CourseQuizAPIResource($quiz);
    }

}
