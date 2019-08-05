<?php

namespace App\Listeners;

use App\Events\ResidentCreatedEvent;
use App\Mail\ResidentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HandleResidentCreatedEvent
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ResidentCreatedEvent $event)
    {
        Mail::to($event->resident->contactEmail)->send(new ResidentCreated($event->resident));

    }
}
