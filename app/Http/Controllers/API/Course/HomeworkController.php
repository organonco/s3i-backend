<?php

namespace App\Http\Controllers\API\Course;

use App\Exceptions\Course\AlreadySubmitted;
use App\Exceptions\NotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\Homework\ShowHomeworkRequest;
use App\Http\Requests\API\Course\Homework\StoreHomeworkRequest;
use App\Http\Resources\API\Course\Items\CourseHomeworkAPIResource;
use App\Models\Course;
use App\Models\CourseHomework;
use App\Models\CourseHomeworkSubmission;
use App\Models\CourseItem;

/**
 * @group Course
 * @subgroup Homework
 */
class HomeworkController extends Controller
{

    /**
     * Submit
     * @authenticated
     * @response {}
     * @responseFile 409 app/Http/Responses/Samples/Course/already-submitted.json
     */
    public function submit(string $itemId, StoreHomeworkRequest $request)
    {
        $homework = CourseItem::byHash($itemId)->item;
        if ($homework->courseHomeworkSubmissions()->byStudent($request->user()->id)->count() > 0)
            throw new AlreadySubmitted;

        /** @var CourseHomeworkSubmission $submission */
        $submission = $homework->courseHomeworkSubmissions()->create(['student_id' => $request->user()->id]);
        $submission->addMediaFromRequest('file')->usingFileName($submission->hash)->toMediaCollection('file');
    }

    /**
     * Show
     * @authenticated
     */
    public function show(string $itemId, ShowHomeworkRequest $request)
    {
        $homework = CourseItem::byHash($itemId)->item;
        return CourseHomeworkAPIResource::make($homework);
    }

}
