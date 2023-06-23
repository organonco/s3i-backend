<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller as BaseController;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getAuthenticatedUser(): ?User
    {
        $user = Auth::user();
        if ($user instanceof User)
            return $user;
        return null;
    }
}
