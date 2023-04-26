<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\Auth\AccountIsFrozen;
use App\Exceptions\Auth\InvalidCredentials;
use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login
     * @group Auth
     * @responseFile app/Http/Responses/Samples/Auth/login.json
     * @responseFile 401 app/Http/Responses/Samples/Auth/invalid-credentials-exception.json
     * @responseFile 401 app/Http/Responses/Samples/Auth/account-frozen-exception.json
     * @responseFile 422 app/Http/Responses/Samples/validation-error.json
     */
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::guard('api')->attempt($request->validated()))
            throw new InvalidCredentials;

        /** @var Student $user */
        $user = Student::where('phone', $request->phone)->first();
        if (!$user->canLogin())
            throw new AccountIsFrozen;

        $user->tokens()->delete();
        $user->incrementNumberOfLoginAttempts();

        return ['token' => $user->createToken('access-token')->plainTextToken];
    }
}
