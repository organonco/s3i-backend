<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\Quiz\ShowQuizRequest;
use App\Http\Resources\API\Course\Items\Quiz\CourseQuizAPIResource;
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
