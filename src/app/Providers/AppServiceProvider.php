<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Keyed by CPF and IP so one attacker cannot lock out a user from every network.
        RateLimiter::for('auth', function (Request $request): Limit {
            $cpf = preg_replace('/\D/', '', (string) $request->input('cpf'));

            return Limit::perMinute(5)->by($cpf.'|'.$request->ip());
        });
    }
}
