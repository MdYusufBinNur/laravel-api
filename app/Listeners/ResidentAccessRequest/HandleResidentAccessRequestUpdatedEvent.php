<?php

namespace App\Listeners\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use App\Listeners\CommonListenerFeatures;
use App\Events\ResidentAccessRequest\ResidentAccessRequestUpdatedEvent;
use App\Mail\ResidentAccessRequest\GeneratePin;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestApproved;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestCompleted;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestDenied;
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

        $hasAFieldValueChanged = $this->hasAFieldValueChanged($residentAccessRequest, $oldResidentAccessRequest, 'status');

        if ($hasAFieldValueChanged['status'] === ResidentAccessRequest::STATUS_APPROVED) {
            Mail::to($residentAccessRequest->email)->send(new ResidentAccessRequestApproved($residentAccessRequest));
        }
        else if ($hasAFieldValueChanged['status'] === ResidentAccessRequest::STATUS_DENIED) {
            Mail::to($residentAccessRequest->email)->send(new ResidentAccessRequestDenied($residentAccessRequest));
        }
        else if ($hasAFieldValueChanged['status'] === ResidentAccessRequest::STATUS_COMPLETED) {
            Mail::to($residentAccessRequest->email)->send(new ResidentAccessRequestCompleted($residentAccessRequest));
        }

        $hasPinGenerated = $this->hasAFieldValueChanged($residentAccessRequest, $oldResidentAccessRequest, 'pin');
        if ($hasPinGenerated) {
            Mail::to($residentAccessRequest->email)->send(new GeneratePin($residentAccessRequest));
        }


    }
}
