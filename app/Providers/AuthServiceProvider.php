<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Blog' => 'App\Policies\BlogPolicy',
         'App\Category' => 'App\Policies\CategoryPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Admin
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        // Content writer
        Gate::define('isWriter', function($user) {
            return $user->role == 'writer';
        });

        // Normal user
        Gate::define('isUser', function($user) {
            return $user->role == 'user';
        });
    }
}
