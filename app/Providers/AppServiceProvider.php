<?php

namespace App\Providers;

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
        //
        if (env('DB_CONNECTION') === 'sqlite' && env('DB_DATABASE') === '/tmp/database.sqlite') {
            if (!file_exists('/tmp/database.sqlite')) {
                file_put_contents('/tmp/database.sqlite', '');
            }
        }


    }
}
