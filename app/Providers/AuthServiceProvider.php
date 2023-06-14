<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\User;
use App\Policies\CoursePolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Course::class => CoursePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('edit-settings', function (User $user) {
            return $user->isSuperAdmin()
                ? Response::allow()
                : Response::deny();
        });
    }
}
