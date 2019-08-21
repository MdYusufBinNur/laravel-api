<?php

namespace App\Listeners\ResidentAccessRequest;

use App\Events\ResidentAccessRequest\ResidentAccessRequestUpdatedEvent;
use App\Mail\ResidentAccessRequest\GeneratePin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleResidentAccessRequestUpdatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ResidentAccessRequestUpdatedEvent $event
     * @return void
     */
    public function handle(ResidentAccessRequestUpdatedEvent $event)
    {
        $residentAccessRequest = $event->residentAccessRequest;
        $eventOptions = $event->options;
        if (isset($eventOptions['pin'])) {
            Mail::to($residentAccessRequest->email)->send(new GeneratePin($residentAccessRequest));
        }
    }
}
