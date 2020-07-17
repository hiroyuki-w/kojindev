<?php

namespace App\Providers;

use App\Models\TrUser;
use Auth;
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
        'App\Models\TrApplication' => 'App\Policies\TrApplicationPolicy',
        'App\Models\TrUser' => 'App\Policies\TrUserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('owner', function (TrUser $trUser) {
            return $trUser->id == Auth::id();
        });
        $this->registerPolicies();

        //
    }
}
