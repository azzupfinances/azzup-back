<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
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
        // Every {month} route segment is YYYY-MM with a real month.
        Route::pattern('month', '[0-9]{4}-(0[1-9]|1[0-2])');

        // Keyed by CPF and IP so one attacker cannot lock out a user from every network.
        RateLimiter::for('auth', function (Request $request): Limit {
            $cpf = preg_replace('/\D/', '', (string) $request->input('cpf'));

            return Limit::perMinute(5)->by($cpf.'|'.$request->ip());
        });
    }
}
