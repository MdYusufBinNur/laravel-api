<?php

namespace App\Providers;

use App\Events\EnterpriseUser\EnterpriseUserCreatedEvent;
use App\Events\Manager\ManagerCreatedEvent;
use App\Events\ResidentAccessRequest\ResidentAccessRequestCreatedEvent;
use App\Events\ResidentAccessRequest\ResidentAccessRequestUpdatedEvent;
use App\Events\Resident\ResidentCreatedEvent;
use App\Listeners\ResidentAccessRequest\HandleResidentAccessRequestCreatedEvent;
use App\Listeners\ResidentAccessRequest\HandleResidentAccessRequestUpdatedEvent;
use App\Listeners\Resident\HandleResidentCreatedEvent;
use App\Listeners\EnterpriseUser\HandleEnterpriseUserCreatedEvent;
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
        ],
        EnterpriseUserCreatedEvent::class => [
            HandleEnterpriseUserCreatedEvent::class
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
