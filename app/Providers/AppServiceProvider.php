<?php

namespace App\Providers;

use App\Services\SMS\SMS;
use App\Services\SMS\SMSMicroService\SMSMicroService;
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
        if (!$this->app->isProduction()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

        // bind SMS
        $this->app->bind(SMS::class, function() {
            return new SMSMicroService();
        });
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
