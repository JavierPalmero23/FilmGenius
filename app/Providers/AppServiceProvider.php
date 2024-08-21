<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
    public function boot() {
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::except([
            '/*',
            '/movies/*',
            '/match/*',
            '/recommend/*',
            '/contact/*',
        ]);
    }
}
