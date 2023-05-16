<?php

namespace App\Http\Controllers\API\Course;

use App\Exceptions\Course\AlreadySubmitted;
use App\Exceptions\NotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\Homework\StoreHomeworkRequest;
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
     * Submit Homework
     * @authenticated
     * @throws NotFound
     * @throws AlreadySubmitted
     */
    public function store(StoreHomeworkRequest $request)
    {
        $item = CourseItem::byHash($request->getItemId());
        $homework = $item->item;

        if (!($request->user()->can('viewDetails', [Course::class, $item->course_id]) && $homework instanceof CourseHomework))
            throw new NotFound;
        if ($homework->courseHomeworkSubmissions()->byStudent($request->user()->id)->count() > 0)
            throw new AlreadySubmitted;

        /** @var CourseHomeworkSubmission $submission */
        $submission = $homework->courseHomeworkSubmissions()->create(['student_id' => $request->user()->id]);
        $submission->addMediaFromRequest('file')->usingFileName($submission->hash)->toMediaCollection('file');
    }

}
