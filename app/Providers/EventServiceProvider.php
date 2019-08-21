<?php

namespace App\Providers;

use App\Events\Manager\ManagerCreatedEvent;
use App\Events\ResidentAccessRequestCreatedEvent;
use App\Events\ResidentAccessRequestUpdatedEvent;
use App\Events\ResidentCreatedEvent;
use App\Listeners\HandleResidentAccessRequestCreatedEvent;
use App\Listeners\HandleResidentAccessRequestUpdatedEvent;
use App\Listeners\HandleResidentCreatedEvent;
use App\Listeners\Manager\HandleManagerCreatedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ResidentCreatedEvent::class => [
            HandleResidentCreatedEvent::class,
        ],
        ResidentAccessRequestCreatedEvent::class => [
            HandleResidentAccessRequestCreatedEvent::class,
        ],

        ResidentAccessRequestUpdatedEvent::class => [
            HandleResidentAccessRequestUpdatedEvent::class,
        ],
        ManagerCreatedEvent::class => [
            HandleManagerCreatedEvent::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
