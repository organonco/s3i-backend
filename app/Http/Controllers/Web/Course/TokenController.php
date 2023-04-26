<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Model\Course\Token\BatchIndexResource;
use App\Http\Resources\Model\Course\Token\BatchResource;
use App\Http\Resources\Model\Course\Token\TokenResource;
use App\Http\Resources\SelectResource;
use App\Http\Resources\TagResource;
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
            'batches' => BatchIndexResource::collection(CourseTokenBatch::all())
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
            'batch' => BatchResource::make($courseTokenBatch),
            'tags' => TagResource::collection(Tag::all())
        ]);
    }

    public function export($courseTokenBatchId)
    {
        $tokens = CourseTokenBatch::byHash($courseTokenBatchId)->tokens;
        TokenResource::exportCSV($tokens, 'hot noodles.csv');
    }
}
