<?php

namespace App\Http\Controllers\API\Course;

use App\Exceptions\NotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\Quiz\ShowQuizRequest;
use App\Http\Resources\API\Course\Items\Quiz\CourseQuizAPIResource;
use App\Models\Course;
use App\Models\CourseItem;
use App\Models\CourseQuiz;

/**
 * @group Course
 * @subgroup Quiz
 */
class QuizController extends Controller
{

    /**
     * Show
     * @throws NotFound
     * @authenticated
     * @responseFile app/Http/Responses/Samples/Quiz/show.json
     * @responseFile 404 app/Http/Responses/Samples/not-found.json
     */
    public function show(string $item_id, ShowQuizRequest $request)
    {
        $item = CourseItem::byHash($item_id);
        if($request->user()->can('viewDetails', [Course::class, $item->course_id]) && $item->item instanceof CourseQuiz)
            return CourseQuizAPIResource::make($item->item);
        else
            throw new NotFound;
    }

}
