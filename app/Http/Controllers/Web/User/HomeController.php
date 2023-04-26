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
        return redirect()->route('dashboard');
    }

    public function dashboard(Request $request): Response
    {
        return Inertia::render('Dashboard');
    }


}
