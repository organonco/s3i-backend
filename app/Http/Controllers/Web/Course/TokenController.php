<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Base\SelectResource;
use App\Http\Resources\Base\TagResource;
use App\Http\Resources\Dashboard\Index\Course\Token\TokenBatchDashboardIndexResource;
use App\Http\Resources\Dashboard\Show\Course\Token\TokenBatchDashboardShowResource;
use App\Models\Course;
use App\Models\CourseTokenBatch;
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
        $batch->courses()->sync($request['courses']);
        for ($i = 0; $i < $request['count']; $i++)
            $batch->tokens()->create();

        $batch->attachTags($request['tags']);
        return redirect()->route('course_token.show', $batch->hash);
    }

    public function create()
    {
        return Inertia::render('CourseToken/Create', [
            'courses' => SelectResource::collection(Course::all()),
            'tags' => TagResource::collection(Tag::all())
        ]);
    }

    public function show($courseTokenBatchId)
    {
        $courseTokenBatch = CourseTokenBatch::byHash($courseTokenBatchId);
        return Inertia::render('CourseToken/Show', [
            'batch' => TokenBatchDashboardShowResource::make($courseTokenBatch->load('courses', 'tags', 'tokens')),
            'tags' => TagResource::collection(Tag::all())
        ]);
    }

    public function export($courseTokenBatchId)
    {
        $tokens = CourseTokenBatch::byHash($courseTokenBatchId)->tokens;
        TokenBatchDashboardShowResource::exportCSV($tokens, 'data.csv');
    }
}
