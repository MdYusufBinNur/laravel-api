<?php

namespace App\Listeners\ServiceRequestMessage;

use App\Events\ServiceRequestMessage\ServiceRequestMessageCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\ServiceRequestLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleServiceRequestMessageCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param ServiceRequestMessageCreatedEvent $event
     * @return void
     */
    public function handle(ServiceRequestMessageCreatedEvent $event)
    {
        $serviceRequestMessage = $event->serviceRequestMessage;
        $eventOptions = $event->options;
        $serviceRequestLogRepository = app(ServiceRequestLogRepository::class);

        $serviceRequestLogRepository->save([
            'serviceRequestId' => $serviceRequestMessage->serviceRequestId,
            'userId' => $serviceRequestMessage->userId,
            'type' => $serviceRequestMessage->type,
            'feedback' => $serviceRequestMessage->serviceRequest->feedback,
            'serviceRequestMessageId' => $serviceRequestMessage->id,
        ]);


    }
}
