<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Web\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function home(Request $request): RedirectResponse
    {
        if(is_null($this->getAuthenticatedUser()))
            return redirect()->route('login');
        if($this->getAuthenticatedUser()->super_admin)
            return redirect()->route('course.index');
        return redirect()->route('classroom.index');
    }
}