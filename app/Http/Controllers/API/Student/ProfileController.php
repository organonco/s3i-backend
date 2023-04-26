<?php

namespace App\Http\Controllers\API\Student;

use App\Exceptions\Profile\InvalidPassword;
use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Student\Profile\ResetPasswordRequest;
use App\Http\Requests\API\Student\Profile\ShowProfileRequest;
use App\Http\Requests\API\Student\Profile\UpdateProfileRequest;
use App\Http\Resources\Model\Student\StudentBaseResource;
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
        return StudentBaseResource::make($request->user());
    }

    /**
     * Reset Password
     * @responseFile 422 app/Http/Responses/Samples/Profile/invalid-password.json
     * @responseFile 422 app/Http/Responses/Samples/validation-error.json
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        if (!Auth::guard('api')->attempt(['phone' => $request->user()->phone, 'password' => $request->old_password]))
            throw new InvalidPassword();
        $request->user()->update(['password' => $request->new_password]);
    }

    /**
     * Update
     * @responseFile app/Http/Responses/Samples/Profile/show.json
     * @responseFile 422 app/Http/Responses/Samples/validation-error.json
     */
    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->validated());
        return StudentBaseResource::make($request->user());
    }
}
