<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \DB::listen(function ($query) {
            if (env('APP_ENV') !== 'prod') {
                \Log::debug("[time: $query->time] " . $query->sql . ' , ' . json_encode($query->bindings));
            }
            // $query->sql
            // $query->bindings
            // $query->time
        });
    }
}
