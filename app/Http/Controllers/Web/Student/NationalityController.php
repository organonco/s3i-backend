<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Model\NationalityResource;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NationalityController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Nationality/Index', [
            'nationalities' => NationalityResource::collection(Nationality::all())
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
            'nationality' => new NationalityResource($nationality)
        ]);
    }

    public function update(Nationality $nationality, Request $request)
    {
        $nationality->update($request->all());
        return redirect()->route('nationality.index');
    }

    public function create(Nationality $nationality, Request $request)
    {
        return Inertia::render('Nationality/Create');
    }

    public function store(Request $request)
    {
        Nationality::create($request->all());
        return redirect()->route('nationality.index');
    }
}
