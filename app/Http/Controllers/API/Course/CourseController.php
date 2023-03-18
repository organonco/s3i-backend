<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\IndexCoursesRequest;
use App\Http\Resources\Model\Course\CourseIndexResource;
use App\Models\Course;

/**
 * @group Course
 */
class CourseController extends Controller
{
    /**
     * Index
     * @responseFile app/Http/Responses/Samples/Course/index.json
     */
    public function index(IndexCoursesRequest $request)
    {
        if($request->hasCategoryId())
            return CourseIndexResource::collection(Course::query()->where('category_id', $request->getCategoryId())->get());
        return CourseIndexResource::collection(Course::all());
    }
}
