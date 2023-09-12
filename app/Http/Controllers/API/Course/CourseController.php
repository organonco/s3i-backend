<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\IndexCoursesRequest;
use App\Http\Requests\API\Course\IndexMyCoursesRequest;
use App\Http\Requests\API\Course\IndexNewCoursesRequest;
use App\Http\Requests\API\Course\ShowCourseRequest;
use App\Http\Resources\API\Course\CourseAPIResource;
use App\Models\Course;

/**
 * @group Course
 */
class CourseController extends Controller
{
    /**
     * Index
     * @authenticated
     * @responseFile app/Http/Responses/Samples/Course/index.json
     */
    public function index(IndexCoursesRequest $request)
    {
        if ($request->hasCategoryId())
            return CourseAPIResource::collection(Course::query()->where('category_id', $request->getCategoryId())->get());
        return CourseAPIResource::collection(Course::all());
    }

    /**
     * New Courses
     * @authenticated
     * @responseFile app/Http/Responses/Samples/Course/index.json
     */
    public function indexNew(IndexNewCoursesRequest $request)
    {
        return CourseAPIResource::collection(Course::query()->orderBy('created_at', 'DESC')->get());
    }

    /**
     * My Courses
     * @authenticated
     * @responseFile app/Http/Responses/Samples/Course/index.json
     */
    public function IndexMyCourses(IndexMyCoursesRequest $request)
    {
        return CourseAPIResource::collection($request->user()->courses);
    }

    /**
     * Show
     * @authenticated
     * @responseFile app/Http/Responses/Samples/Course/show.json
     */
    public function show(Course $course, ShowCourseRequest $request)
    {
        return CourseAPIResource::make($course->load('courseItems'));
    }

}
