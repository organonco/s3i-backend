<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Dashboard\Index\Student\NationalityDashboardIndexResource;
use App\Http\Resources\Dashboard\Show\Student\NationalityDashboardShowResource;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NationalityController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Nationality/Index', [
            'nationalities' => NationalityDashboardIndexResource::collection(Nationality::all())
        ]);
    }

    public function destroy(Nationality $nationality)
    {
        $nationality->delete();
        return redirect()->route('nationality.index');
    }

    public function edit(Nationality $nationality)
    {
        return Inertia::render('Nationality/Edit', [
            'nationality' => new NationalityDashboardShowResource($nationality)
        ]);
    }

    public function update(Nationality $nationality, Request $request)
    {
        $request->validate(['name' => 'required']);
        $nationality->update($request->all());
        return redirect()->route('nationality.index');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Nationality::create($request->all());
        return redirect()->route('nationality.index');
    }

    public function create()
    {
        return Inertia::render('Nationality/Create');
    }
}
