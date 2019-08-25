<?php

namespace App\Listeners\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use App\Listeners\CommonListenerFeatures;
use App\Events\ResidentAccessRequest\ResidentAccessRequestUpdatedEvent;
use App\Mail\ResidentAccessRequest\GeneratePin;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleResidentAccessRequestUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

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
        $oldResidentAccessRequest = $eventOptions['oldResidentAccessRequest'];

        $hasStatusChangedToApproved = $this->hasAFieldValueChangedTo($residentAccessRequest, $oldResidentAccessRequest, 'status', ResidentAccessRequest::STATUS_APPROVED);
        if ($hasStatusChangedToApproved) {
            Mail::to($residentAccessRequest->email)->send(new ResidentAccessRequestApproved($residentAccessRequest));

        }

        $hasPinGenerated = $this->hasAFieldValueChanged($residentAccessRequest, $oldResidentAccessRequest, 'pin');
        if ($hasPinGenerated) {
            Mail::to($residentAccessRequest->email)->send(new GeneratePin($residentAccessRequest));
        }


    }
}
