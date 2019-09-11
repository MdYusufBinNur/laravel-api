<?php

namespace App\Listeners\ServiceRequest;

use App\DbModels\ServiceRequestLog;
use App\Events\ServiceRequest\ServiceRequestCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\ServiceRequestLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleServiceRequestCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param ServiceRequestCreatedEvent $event
     * @return void
     */
    public function handle(ServiceRequestCreatedEvent $event)
    {
        $serviceRequest = $event->serviceRequest;
        $eventOptions = $event->options;

        $serviceRequestLogRepository = app(ServiceRequestLogRepository::class);

        $serviceRequestLogRepository->save([
            'serviceRequestId' => $serviceRequest->id,
            'userId' => $serviceRequest->userId,
            'type' => ServiceRequestLog::TYPE_CREATED,
        ]);


    }
}
