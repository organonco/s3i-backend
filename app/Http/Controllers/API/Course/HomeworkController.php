<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\Homework\StoreHomeworkRequest;
use App\Models\CourseHomework;

/**
 * @group Course
 * @subgroup Homework
 */
class HomeworkController extends Controller
{

    /**
     * Submit Homework
     */
    public function store(CourseHomework $quiz, StoreHomeworkRequest $request)
    {

    }

}
