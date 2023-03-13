<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\API\RegisterDataResource;
use App\Http\Resources\Model\EducationLevelResource;
use App\Models\EducationLevel;
use App\Models\Student;

class RegisterController extends Controller
{

    /**
     * Get Register Data
     * @responseFile app/Http/Responses/Samples/Auth/register.show.json
     * @group Auth
     */
    public function show()
    {
        return new RegisterDataResource(null);
    }


    /**
     * Register
     * @group Auth
     * @responseFile 422 app/Http/Responses/Samples/validation-error.json
     */
    public function store(RegisterRequest $request)
    {
        Student::create($request->all());
    }
}
