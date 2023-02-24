<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\API\Auth\LogoutRequest;

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
