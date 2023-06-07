<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();


        Passport::tokensExpireIn(now()->addDays(env('TOKEN_LIFETIME', 2)));
        Passport::refreshTokensExpireIn(now()->addDays(env('REFRESH_TOKEN_LIFETIME', 90)));
    }
}
