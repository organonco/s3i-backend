<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Model\CategoryResource;
use App\Http\Resources\Model\CourseResource;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Course/Index', [
            'courses' => CourseResource::collection(Course::all())
        ]);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('course.index');
    }

    public function edit(Course $course)
    {
        return Inertia::render('Course/Edit', [
            "categories" => CategoryResource::collection(Category::all()),
            'course' => new CourseResource($course)
        ]);
    }

    public function update(Course $course, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'introduction_video_url' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image',
        ]);
        $course->update($request->all());
        if($request->hasFile('image'))
            $course->addMediaFromRequest('image')->toMediaCollection("image");
        return redirect()->route('course.index');
    }

    public function create(Course $course, Request $request)
    {
        return Inertia::render('Course/Create', [
            "categories" => CategoryResource::collection(Category::all())
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'introduction_video_url' => 'required',
            'category_id' => 'required',
            'image' => 'required|image',
        ]);
        /** @var Course $course */
        $course = Course::create($request->all());
        $course->addMediaFromRequest('image')->toMediaCollection('iamge');
        return redirect()->route('course.index');
    }
}
