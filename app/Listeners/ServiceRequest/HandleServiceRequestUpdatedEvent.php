<?php

namespace App\Listeners\ServiceRequest;

use App\DbModels\ServiceRequestLog;
use App\Events\ServiceRequest\ServiceRequestUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\ServiceRequestLogRepository;
use App\Repositories\Contracts\ServiceRequestOfficeDetailRepository;
use App\Services\Helpers\SmsHelper;
use Illuminate\Contracts\Queue\ShouldQueue;

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
            SmsHelper::sendServiceRequestStatusUpdatedNotification($serviceRequest);
            $serviceRequestLogRepository->save([
                'serviceRequestId' => $serviceRequest->id,
                'userId' => $eventOptions['request']['loggedInUserId'],
                'type' => ServiceRequestLog::TYPE_STATUS,
                'status' => $serviceRequest->status,
            ]);
        }

        // log `feedback` changes
        if ($this->hasAFieldValueChanged($serviceRequest, $oldServiceRequest, 'feedback')) {
            $serviceRequestLogRepository->save([
                'serviceRequestId' => $serviceRequest->id,
                'userId' => $eventOptions['request']['loggedInUserId'],
                'feedback' => $serviceRequest->feedback,
                'type' => ServiceRequestLog::TYPE_FEEDBACK,
            ]);
        }

        // log `assignment` changes
        if ($this->hasAFieldValueChanged($serviceRequest, $oldServiceRequest, 'userId')) {

            $serviceRequestOfficeDetailsRepository = app(ServiceRequestOfficeDetailRepository::class);

            $serviceRequestOfficeDetailsRepository->setServiceRequestOfficeDetail(['serviceRequestId' => $serviceRequest->id, 'assignedUserId' => $serviceRequest->userId]);
            $serviceRequestLogRepository->save([
                'serviceRequestId' => $serviceRequest->id,
                'userId' => $eventOptions['request']['loggedInUserId'],
                'type' => ServiceRequestLog::TYPE_ASSIGNMENT,
            ]);

            SmsHelper::sendServiceRequestAssignedNotification($serviceRequest);

        }

        // todo log comment

    }
}
