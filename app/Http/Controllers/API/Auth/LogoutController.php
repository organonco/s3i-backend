<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\LogoutRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Logout
     * @authenticated
     * @group Auth
     */
    public function __invoke(LogoutRequest $request)
    {
        $request->user()->tokens()->delete();
    }
}
