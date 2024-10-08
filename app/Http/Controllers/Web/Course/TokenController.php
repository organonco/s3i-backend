<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Base\Course\Token\TokenResource;
use App\Http\Resources\Base\SelectResource;
use App\Http\Resources\Base\TagResource;
use App\Http\Resources\Dashboard\Index\Course\Token\TokenBatchDashboardIndexResource;
use App\Http\Resources\Dashboard\Index\Course\Token\TokenDashboardIndexResource;
use App\Http\Resources\Dashboard\Show\Course\Token\TokenBatchDashboardShowResource;
use App\Http\Resources\Dashboard\Show\Course\Token\TokenDashboardShowResource;
use App\Models\Course;
use App\Models\CourseTokenBatch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Tags\Tag;


class TokenController extends Controller
{
    public function index()
    {
        return Inertia::render('CourseToken/Index', [
            'batches' => TokenBatchDashboardIndexResource::collection(CourseTokenBatch::all())
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'courses' => 'required|array',
            'expiry_date' => 'required',
            'count' => 'required|integer',
            'tags' => 'array'
        ]);

        $batch = CourseTokenBatch::create(['expires_at' => $request['expiry_date']]);

        $courses = $request['courses'];
        foreach($courses as $index => $course)
            $courses[$index] = Course::hashToId($course);

        $batch->courses()->sync($courses);

        for ($i = 0; $i < $request['count']; $i++)
            $batch->tokens()->create();

        $batch->attachTags($request['tags']);
        return redirect()->route('course_token.show', $batch->hash);
    }

    public function create()
    {
        return Inertia::render('CourseToken/Create', [
            'courses' => SelectResource::collection(Course::all()),
            'tags' => Tag::all()->pluck('name')
        ]);
    }

    public function show($courseTokenBatchId)
    {
        $courseTokenBatch = CourseTokenBatch::byHash($courseTokenBatchId);
        return Inertia::render('CourseToken/Show', [
            'batch' => TokenBatchDashboardShowResource::make($courseTokenBatch->load('courses', 'tags', 'tokens')),
            'tags' => Tag::all()->pluck('name')
        ]);
    }

    public function export($courseTokenBatchId)
    {
        $batch = CourseTokenBatch::byHash($courseTokenBatchId);
        $tokens = $batch->tokens;
        TokenDashboardIndexResource::exportCSV($tokens, $batch->hash . ' (' . Carbon::now()->format('d-m-Y') . ').csv');
    }
}
