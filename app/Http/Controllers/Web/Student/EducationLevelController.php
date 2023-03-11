<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Model\EducationLevelResource;
use App\Models\EducationLevel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EducationLevelController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('EducationLevels/Index', [
            'education_levels' => EducationLevelResource::collection(EducationLevel::all())
        ]);
    }

    public function destroy(EducationLevel $educationLevel)
    {
        $educationLevel->delete();
        return redirect()->route('education_level.index');
    }

    public function edit(EducationLevel $educationLevel)
    {
        return Inertia::render('EducationLevels/Edit', [
            'education_level' => new EducationLevelResource($educationLevel)
        ]);
    }

    public function update(EducationLevel $educationLevel, Request $request)
    {
        $educationLevel->update($request->all());
        return redirect()->route('education_level.index');
    }

    public function create(Request $request)
    {
        return Inertia::render('EducationLevels/Create');
    }

    public function store(Request $request)
    {
        EducationLevel::create($request->all());
        return redirect()->route('education_level.index');
    }
}
