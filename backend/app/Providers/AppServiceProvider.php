<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    final public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    final public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        if (app()->isProduction()){
            DB::whenQueryingForLongerThan(CarbonInterval::seconds(5), function (Connection $connection) {
                Log::info("Connection to DB more 5s ({$connection->totalQueryDuration()})");
            });

            DB::listen(function ($query) {
                if ($query->time > 500) {
                    Log::info("Request more 500ms ($query->time). Query: $query->sql");
                }
            });
        }

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
