<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login
     * @group Auth
     * @responseFile app/Http/Responses/Samples/Auth/login.json
     */
    public function __invoke(LoginRequest $request)
    {
//        return $request->validated();
        if(Auth::guard('api')->attempt($request->validated())){
            $token = Student::where('phone' , $request->phone)->first()->createToken('access-token');
            return ['token' => $token->plainTextToken];
        }else{
            return false;
        }
    }
}
