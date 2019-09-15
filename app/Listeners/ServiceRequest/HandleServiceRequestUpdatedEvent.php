<?php

namespace App\Listeners\ServiceRequest;

use App\DbModels\ResidentAccessRequest;
use App\DbModels\ServiceRequestLog;
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
        $oldServiceRequest = $eventOptions['oldModel'];

        $serviceRequestLogRepository = app(ServiceRequestLogRepository::class);

        // log `status` changes
        if ($this->hasAFieldValueChanged($serviceRequest, $oldServiceRequest, 'status')) {
            $serviceRequestLogRepository->save([
                'serviceRequestId' => $serviceRequest->id,
                'userId' => $serviceRequest->userId,
                'type' => ServiceRequestLog::TYPE_STATUS,
                'status' => $serviceRequest->status,
            ]);
        }

        // log `feedback` changes
        if ($this->hasAFieldValueChanged($serviceRequest, $oldServiceRequest, 'feedback')) {
            $serviceRequestLogRepository->save([
                'serviceRequestId' => $serviceRequest->id,
                'userId' => $serviceRequest->userId,
                'feedback' => $serviceRequest->feedback,
                'type' => ServiceRequestLog::TYPE_FEEDBACK,
            ]);
        }

        // log `assignment` changes
        if ($this->hasAFieldValueChanged($serviceRequest, $oldServiceRequest, 'userId')) {
            $serviceRequestLogRepository->save([
                'serviceRequestId' => $serviceRequest->id,
                'userId' => $serviceRequest->userId,
                'type' => ServiceRequestLog::TYPE_ASSIGNMENT,
            ]);
        }

        // todo log comment

    }
}
