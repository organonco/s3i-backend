<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\Auth\AccountAlreadyVerified;
use App\Exceptions\Auth\InvalidCode;
use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\VerifyRequest;
use App\Http\Resources\API\RegisterDataResource;
use App\Models\Verification;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     */
    public function send()
    {
        $student = $this->getAuthenticatedStudent();
        if ($student->is_verified)
            throw new AccountAlreadyVerified;
        $student->verifications()->create(['code' => rand(100000, 999999)]);
        //TODO: notify
    }

    /**
     * Verify
     * @authenticated
     * @response {}
     * @responseFile 403 app/Http/Responses/Samples/Auth/account-already-verified-exception.json
     * @responseFile 403 app/Http/Responses/Samples/Auth/invalid-code.json
     */
    public function verify($verification_id, VerifyRequest $request)
    {
        $verification = Verification::byHash($verification_id);
        $student = $this->getAuthenticatedStudent();
        if ($student->is_verified)
            throw new AccountAlreadyVerified;
        if($verification->student_id != $student->id)
            throw new NotFoundHttpException;
        if($verification->code != $request->getCode())
            throw new InvalidCode;

        $verification->markAsVerified();
    }

}
