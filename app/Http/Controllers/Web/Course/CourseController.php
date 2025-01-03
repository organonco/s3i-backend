<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Base\SelectResource;
use App\Http\Resources\Dashboard\Index\Course\CourseDashboardIndexResource;
use App\Http\Resources\Dashboard\Show\Course\CourseDashboardShowResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseItem;
use App\Models\User;
use App\Notifications\NewItemsAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Inertia\Response;
use Veelasky\LaravelHashId\Rules\ExistsByHash;

class CourseController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Course/Index', [
            'courses' => CourseDashboardIndexResource::collection(Course::all())
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
            "categories" => SelectResource::collection(Category::all()),
            'course' => new CourseDashboardShowResource($course->load('category', 'courseItems', 'courseItems.item')),
            'teachers' => SelectResource::collection(User::query()->teachers()->get()),
        ]);
    }

    public function update(Course $course, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'introduction_video_url' => 'nullable',
            'telegram_url' => 'nullable',
            'category_id' => ['required', new ExistsByHash(Category::class)],
            'image' => 'nullable|image',
            'items' => 'required',
            'items.*.type' => 'required',
            'items.*.object' => 'required',
            'user_ids' => 'required|array',
            'user_ids.*' => ['required', new ExistsByHash(User::class)],
            'price' => ['nullable', 'numeric'],
        ]);
        $course->update(array_merge($request->all(), ['category_id' => Category::hashToId($request->category_id)]));

        if ($request->hasFile('image'))
            $course->addMediaFromRequest('image')->toMediaCollection("image");

        $userIds = collect($request->user_ids)->transform(function (string $hash) {
            return User::hashToId($hash);
        });

        $course->users()->sync($userIds);
        $course->save();

        $remainingIds = collect($request->items)->whereNotNull('id')->pluck(['id'])->transform(function ($hash) {
            return CourseItem::hashToId($hash);
        });

        $hasNewItems = collect($request->items)->whereNull('id')->count() > 0;

        if ($hasNewItems)
            Notification::send($course->students, new NewItemsAdded($course));

        $course->courseItems()->whereNotIn('id', $remainingIds)->delete();

        foreach ($request->items as $order => $item)
            CourseItem::createOrUpdateFromDataObject($item, $order, $course->id);

        return redirect()->route('course.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'introduction_video_url' => 'nullable',
            'telegram_url' => 'nullable',
            'category_id' => ['required', new ExistsByHash(Category::class)],
            'user_ids' => 'required|array',
            'user_ids.*' => ['required', new ExistsByHash(User::class)],
            'image' => 'required|image',
            'items' => 'required',
            'items.*.type' => 'required',
            'items.*.object' => 'required',
            'price' => ['nullable', 'numeric'],
        ]);
        /** @var Course $course */
        $course = Course::create(array_merge($request->all(), [
            'category_id' => Category::hashToId($request->category_id)
        ]));

        $userIds = collect($request->user_ids)->transform(function (string $hash) {
            return User::hashToId($hash);
        });

        $course->users()->sync($userIds);
        $course->save();

        foreach ($request->items as $order => $item)
            CourseItem::createOrUpdateFromDataObject($item, $order, $course->id);

        $course->addMediaFromRequest('image')->toMediaCollection('image');
        return redirect()->route('course.index');
    }

    public function create(Course $course, Request $request)
    {
        return Inertia::render('Course/Create', [
            "categories" => SelectResource::collection(Category::all()),
            'teachers' => SelectResource::collection(User::query()->teachers()->get()),
        ]);
    }
}
