<?php

namespace App\Listeners\ServiceRequest;

use App\DbModels\ServiceRequestLog;
use App\Events\ServiceRequest\ServiceRequestCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\ServiceRequest\ServiceRequestCreated;
use App\Repositories\Contracts\ServiceRequestLogRepository;
use App\Services\Helpers\SmsHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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

        $unit = $serviceRequest->unit;
        $residents = $unit->residents;

        foreach ($residents as $resident) {
            Mail::to($resident->user->email)->send(new ServiceRequestCreated($serviceRequest, $unit));
        }

        $serviceRequestLogRepository = app(ServiceRequestLogRepository::class);

        $serviceRequestLogRepository->save([
            'serviceRequestId' => $serviceRequest->id,
            'userId' => $serviceRequest->userId,
            'type' => ServiceRequestLog::TYPE_CREATED,
        ]);

        SmsHelper::sendServiceRequestCreatedNotification($serviceRequest);

    }
}
