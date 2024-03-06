<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Dashboard\Index\TeacherDashboardIndexResource;
use App\Http\Resources\Dashboard\Show\TeacherDashboardShowResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeacherController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Teacher/Index', [
            'teachers' => TeacherDashboardIndexResource::collection(User::query()->teachers()->get())
        ]);
    }

    public function destroy(User $teacher)
    {
        $teacher->delete();
        return redirect()->route('teacher.index');
    }

    public function edit(User $teacher)
    {
        return Inertia::render('Teacher/Edit', [
            'teacher' => TeacherDashboardShowResource::make($teacher)
        ]);
    }

    public function update(User $teacher, Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'username' => 'required|alpha|unique:users,username,' . $teacher->id,
            'password' => 'nullable|min:8',
            'bio' => 'nullable',
            'education' => 'nullable',
            'image' => 'nullable|image',
            'visible' => 'nullable|boolean',
        ]);

        $teacher->update(array_merge(array_filter($request->all()), [
            'super_admin' => 0,
            'visible' => ($request->visible == true)
        ]));

        if($request->hasFile('image'))
            $teacher->addMediaFromRequest('image')->toMediaCollection("image");

        return redirect()->route('teacher.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|alpha|unique:users',
            'password' => 'required|min:8',
            'bio' => 'nullable',
            'education' => 'nullable',
            'image' => 'nullable|image',
            'visible' => 'nullable|boolean',
        ]);

        $user = User::create(array_merge(array_filter($request->all()), [
            'super_admin' => 0,
            'visible' => ($request->visible == true)
        ]));
        
        if($request->hasFile('image'))
            $user->addMediaFromRequest('image')->toMediaCollection("image");

        return redirect()->route('teacher.index');
    }

    public function create()
    {
        return Inertia::render('Teacher/Create');
    }
}