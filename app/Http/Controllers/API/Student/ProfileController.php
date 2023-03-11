<?php

namespace App\Http\Controllers\API\Student;

use App\Exceptions\Profile\InvalidPassword;
use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Student\Profile\ResetPasswordRequest;
use App\Http\Requests\API\Student\Profile\ShowProfileRequest;
use App\Http\Requests\API\Student\Profile\UpdateProfileRequest;
use App\Http\Resources\Model\StudentResource;
use Illuminate\Support\Facades\Auth;

/**
 * @group Profile
 * @authenticated
 */
class ProfileController extends Controller
{
    /**
     * Show
     * @responseFile app/Http/Responses/Samples/Profile/show.json
     */
    public function show(ShowProfileRequest $request)
    {
        return new StudentResource($request->user());
    }

    /**
     * Update
     */
    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->validated());
    }

    /**
     * Reset Password
     * @responseFile 422
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        if(!Auth::guard('api')->attempt(['phone' => $request->user()->phone, 'password' => $request->old_password]))
            throw new InvalidPassword();
        $request->user()->update(['password' => $request->new_password]);
    }
}
