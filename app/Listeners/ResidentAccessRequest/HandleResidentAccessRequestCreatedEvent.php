<?php

namespace App\Listeners\ResidentAccessRequest;

use App\Events\ResidentAccessRequest\ResidentAccessRequestCreatedEvent;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleResidentAccessRequestCreatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ResidentAccessRequestCreatedEvent $event
     * @return void
     */
    public function handle(ResidentAccessRequestCreatedEvent $event)
    {
        $residentAccessRequest = $event->residentAccessRequest;
        $eventOptions = $event->options;

        Mail::to($residentAccessRequest->email)->send(new ResidentAccessRequestCreated($residentAccessRequest));
    }
}
