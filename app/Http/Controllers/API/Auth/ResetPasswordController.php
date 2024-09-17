<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\Auth\CodeExpired;
use App\Exceptions\Auth\InvalidCode;
use App\Exceptions\NotFound;
use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\ResetPasswordRequest;
use App\Http\Requests\API\Auth\SendVerificationCodeRequest;
use App\Http\Resources\Base\VerificationResource;
use App\Models\PasswordResetToken;
use App\Models\Student;
use App\Models\Verification;
use App\Notifications\PasswordReset;

/**
 * @group Auth
 */
class ResetPasswordController extends Controller
{
    /**
     * Send Password Reset Code Code
	 * @responseFile app/Http/Responses/Samples/Auth/verification.json
     */
    public function send(SendVerificationCodeRequest $request)
    {
        $student = Student::where('phone', $request->phone)->firstOrFail();
        $passwordReset = $student->passwordResetTokens()->create(['code' => rand(100000, 999999)]);
		// $student->notify(new PasswordReset($passwordReset));
        return VerificationResource::make($passwordReset);
    }

    /**
     * Verify
     * @authenticated
     * @responseFile 403 app/Http/Responses/Samples/Auth/code-expired.json
     * @responseFile 403 app/Http/Responses/Samples/Auth/invalid-code.json
     * @responseFile 404 app/Http/Responses/Samples/not-found.json
     *
     * @throws NotFound
     * @throws InvalidCode
     * @throws CodeExpired
     */
    public function reset($passwordResetTokenId, ResetPasswordRequest $request)
    {
        $passwordResetToken = PasswordResetToken::byHashOrFail($passwordResetTokenId);
        $student = $passwordResetToken->student;
		
        if ($passwordResetToken->student_id != $student->id)
            throw new NotFound;
        if($passwordResetToken->is_used || $passwordResetToken->is_expired)
            throw new CodeExpired;
        if ($passwordResetToken->code != $request->getCode())
            throw new InvalidCode;

        $student->resetPassword($request->getPasswordInput());

		$passwordResetToken->markAsUsed();
    }

}
