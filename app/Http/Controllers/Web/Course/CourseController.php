<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Model\Category\CategoryResource;
use App\Http\Resources\Model\Course\CourseBaseResource;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Veelasky\LaravelHashId\Rules\ExistsByHash;

class CourseController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Course/Index', [
            'courses' => CourseBaseResource::collection(Course::all())
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
            'course' => new CourseBaseResource($course)
        ]);
    }

    public function update(Course $course, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'introduction_video_url' => 'required',
            'category_id' => ['required', new ExistsByHash(Category::class)],
            'image' => 'nullable|image',
        ]);
        $request->category_id = Category::hashToId($request->category_id);
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
            'category_id' => ['required', new ExistsByHash(Category::class)],
            'image' => 'required|image',
        ]);
        $course = Course::create(array_merge($request->all(), [
            'category_id' => Category::hashToId($request->category_id)
        ]));
        $course->addMediaFromRequest('image')->toMediaCollection('image');
        return redirect()->route('course.index');
    }
}
