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
        $noOfRequests = 0;
        \DB::listen(function ($query) use (&$noOfRequests) {
            if (env('APP_ENV') !== 'prod') {
                $noOfRequests++;
                \Log::debug("$noOfRequests - [time: $query->time] " . $query->sql . ' , ' . json_encode($query->bindings));
            }
        });
    }
}
