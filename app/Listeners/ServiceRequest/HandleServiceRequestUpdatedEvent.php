<?php

namespace App\Listeners\ServiceRequest;

use App\DbModels\ResidentAccessRequest;
use App\Events\ServiceRequest\ServiceRequestUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Events\ResidentAccessRequest\ResidentAccessRequestUpdatedEvent;
use App\Mail\ResidentAccessRequest\GeneratePin;
use App\Mail\ResidentAccessRequest\ResidentAccessRequestApproved;
use App\Repositories\Contracts\ServiceRequestLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleServiceRequestUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param ServiceRequestUpdatedEvent $event
     * @return void
     */
    public function handle(ServiceRequestUpdatedEvent $event)
    {
        $serviceRequest = $event->serviceRequest;
        $eventOptions = $event->options;
        $oldServiceRequest = $eventOptions['oldServiceRequest'];

        $serviceRequestLogRepository = app(ServiceRequestLogRepository::class);

        // log `status` changes
        if ($this->hasAFieldValueChanged($serviceRequest, $oldServiceRequest, 'status')) {
            $serviceRequestLogRepository->save([
                'serviceRequestId' => $serviceRequest->id,
                'userId' => $serviceRequest->userId,
                'type' => 'status',
                'status' => $serviceRequest->status,
            ]);
        }

        // log `feedback` changes
        if ($this->hasAFieldValueChanged($serviceRequest, $oldServiceRequest, 'feedback')) {
            $serviceRequestLogRepository->save([
                'serviceRequestId' => $serviceRequest->id,
                'userId' => $serviceRequest->userId,
                'feedback' => $serviceRequest->feedback,
                'type' => 'feedback',
            ]);
        }

        // todo log comment

    }
}
