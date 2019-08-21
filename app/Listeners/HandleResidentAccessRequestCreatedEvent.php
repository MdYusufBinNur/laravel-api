<?php

namespace App\Listeners;

use App\Events\ResidentAccessRequestCreatedEvent;
use App\Events\ResidentCreatedEvent;
use App\Mail\ResidentAccessRequestCreated;
use App\Mail\ResidentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
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
