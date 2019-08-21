<?php

namespace App\Listeners\Resident;

use App\Events\Resident\ResidentCreatedEvent;
use App\Mail\Resident\ResidentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleResidentCreatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ResidentCreatedEvent $event
     * @return void
     */
    public function handle(ResidentCreatedEvent $event)
    {
        Mail::to($event->resident->contactEmail)->send(new ResidentCreated($event->resident));
    }
}
