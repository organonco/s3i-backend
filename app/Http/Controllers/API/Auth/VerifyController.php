<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\Auth\AccountAlreadyVerified;
use App\Exceptions\Auth\CodeExpired;
use App\Exceptions\Auth\InvalidCode;
use App\Exceptions\NotFound;
use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\VerifyRequest;
use App\Http\Resources\Base\VerificationResource;
use App\Models\Verification;

/**
 * @group Auth
 */
class VerifyController extends Controller
{
    /**
     * Send Verification Code
     * @authenticated
     * @response {}
     * @responseFile 403 app/Http/Responses/Samples/Auth/account-already-verified-exception.json
     * @throws AccountAlreadyVerified
     */
    public function send()
    {
        $student = $this->getAuthenticatedStudent();
        if ($student->is_verified)
            throw new AccountAlreadyVerified;
        $verification = $student->verifications()->create(['code' => rand(100000, 999999)]);
        return VerificationResource::make($verification);
        //TODO: notify
    }

    /**
     * Verify
     * @authenticated
     * @response {}
     * @responseFile 403 app/Http/Responses/Samples/Auth/account-already-verified-exception.json
     * @responseFile 403 app/Http/Responses/Samples/Auth/code-expired.json
     * @responseFile 403 app/Http/Responses/Samples/Auth/invalid-code.json
     * @responseFile 404 app/Http/Responses/Samples/not-found.json
     *
     * @throws AccountAlreadyVerified
     * @throws NotFound
     * @throws InvalidCode
     * @throws CodeExpired
     */
    public function verify($verification_id, VerifyRequest $request)
    {
        $verification = Verification::byHash($verification_id);
        $student = $this->getAuthenticatedStudent();
        if ($student->is_verified)
            throw new AccountAlreadyVerified;
        if ($verification->student_id != $student->id)
            throw new NotFound;
        if($verification->is_expired)
            throw new CodeExpired;
        if ($verification->code != $request->getCode())
            throw new InvalidCode;

        $verification->markAsVerified();
    }

}
