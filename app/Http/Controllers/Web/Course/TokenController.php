<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Model\Course\Token\BatchResource;
use App\Http\Resources\SelectResource;
use App\Models\Course;
use App\Models\CourseToken;
use App\Models\CourseTokenBatch;
use Inertia\Inertia;
use Illuminate\Http\Request;


class TokenController extends Controller
{
    public function index()
    {
        return Inertia::render('CourseToken/Index', [
            'batches' => BatchResource::collection(CourseTokenBatch::all())
        ]);
    }

    public function create()
    {
        return Inertia::render('CourseToken/Create', [
            'courses' => SelectResource::collection(Course::all())
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'courses' => 'required|array',
            'expiry_date' => 'required',
            'count' => 'required|integer'
        ]);

        $batch = CourseTokenBatch::create(['expires_at' => $request['expiry_date']]);
        $batch->courses()->sync($request['courses']);
        for($i = 0; $i < $request['count']; $i++)
            $batch->tokens()->create();
    }
}
