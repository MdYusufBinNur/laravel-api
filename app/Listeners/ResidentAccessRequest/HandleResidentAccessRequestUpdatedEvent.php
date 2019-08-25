<?php

namespace App\Listeners\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
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

        if ($this->needToSendPin($residentAccessRequest, $eventOptions)) {
            Mail::to($residentAccessRequest->email)->send(new GeneratePin($residentAccessRequest));
        }
    }

    /**
     * check if pin need to send
     *
     * @param $residentAccessRequest
     * @param $eventOptions
     * @return bool
     */
    private function needToSendPin($residentAccessRequest, $eventOptions)
    {
        $oldResidentAccessRequest = $eventOptions['oldResidentAccessRequest'];
        if (isset($eventOptions['status'])
            && $residentAccessRequest->status === ResidentAccessRequest::STATUS_APPROVED
            && $oldResidentAccessRequest->status != ResidentAccessRequest::STATUS_APPROVED
        ) {
            return true;
        }

        if (isset($eventOptions['pin'])) {
            return true;
        }
        return false;
    }
}
