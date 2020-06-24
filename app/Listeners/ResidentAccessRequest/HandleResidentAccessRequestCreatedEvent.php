<?php

namespace App\Listeners\ResidentAccessRequest;

use App\Events\ResidentAccessRequest\ResidentAccessRequestCreatedEvent;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestCreated;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestToStaffCreated;
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

        $toStaffUsers = $residentAccessRequest->property->staffUsers;

        /* Sending mail to request user */
        Mail::to($residentAccessRequest->email)->send(new ResidentAccessRequestCreated($residentAccessRequest));

        /* sending mail to staff of the property */
        foreach ($toStaffUsers as $user) {
            Mail::to($user->email)->send(new ResidentAccessRequestToStaffCreated($residentAccessRequest));
        }
    }
}
