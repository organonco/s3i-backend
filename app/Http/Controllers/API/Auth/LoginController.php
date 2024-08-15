<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\Auth\AccountIsFrozen;
use App\Exceptions\Auth\InvalidCredentials;
use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\Base\VerificationResource;
use App\Models\Student;
use App\Notifications\OTP;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	/**
	 * Login
	 * @group Auth
	 * @responseFile app/Http/Responses/Samples/Auth/login.json
	 * @responseFile app/Http/Responses/Samples/Auth/verification.json
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

		if (!$user->is_verified) {
			$verification = $user->verifications()->create(['code' => rand(100000, 999999)]);
			$user->notify(new OTP($verification));
			return VerificationResource::make($verification);
		}

		$user->tokens()->delete();
		$user->incrementNumberOfLoginAttempts();

		return ['token' => $user->createToken('access-token')->plainTextToken];
	}
}
