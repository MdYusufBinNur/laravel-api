<?php

namespace App\Listeners\ParkingPass;

use App\Events\ParkingPass\ParkingPassCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\ParkingPassLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleParkingPassCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param ParkingPassCreatedEvent $event
     * @return void
     */
    public function handle(ParkingPassCreatedEvent $event)
    {
        $parkingPass = $event->parkingPass;
        $eventOptions = $event->options;

        $parkingPassLogRepository = app(ParkingPassLogRepository::class);

        $parkingPassLogRepository->save([
            'propertyId' => $parkingPass->propertyId,
            'passId' => $parkingPass->id,
            'spaceId' => $parkingPass->spaceId,
            'make' => $parkingPass->make,
            'model' => $parkingPass->model,
            'licensePlate' => $parkingPass->licensePlate,
            'startAt' => $parkingPass->startAt,
            'endAt' => $parkingPass->endAt,
            'event' => 'created'
        ]);

    }
}
