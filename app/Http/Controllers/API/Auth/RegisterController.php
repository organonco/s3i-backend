<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Models\Student;

class RegisterController extends Controller
{
    /**
     * Register
     * @group Auth
     * @responseFile 422 app/Http/Responses/Samples/validation-error.json
     */
    public function __invoke(RegisterRequest $request)
    {
        Student::create($request->validated());
    }
}
