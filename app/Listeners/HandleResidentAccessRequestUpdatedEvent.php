<?php

namespace App\Listeners;

use App\Events\ResidentAccessRequestUpdatedEvent;
use App\Mail\GeneratePin;
use App\Mail\ResidentAccessRequestCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
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
