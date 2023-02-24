<?php

namespace App\Http\Controllers\API\Student;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Student\Profile\ShowProfileRequest;
use App\Http\Requests\API\Student\Profile\UpdateProfileRequest;
use App\Http\Resources\StudentResource;

class ProfileController extends Controller
{
    /**
     * Show
     * @group Profile
     * @authenticated
     */
    public function show(ShowProfileRequest $request)
    {
        return new StudentResource($request->user());
    }

    /**
     * Update
     * @group Profile
     * @authenticated
     */
    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->validated());
    }
}
