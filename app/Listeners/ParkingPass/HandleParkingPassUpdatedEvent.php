<?php

namespace App\Listeners\ParkingPass;

use App\Events\ParkingPass\ParkingPassUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\ParkingPassLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleParkingPassUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param ParkingPassUpdatedEvent $event
     * @return void
     */
    public function handle(ParkingPassUpdatedEvent $event)
    {
        $parkingPass = $event->parkingPass;
        $eventOptions = $event->options;
        $oldParkingPass = $eventOptions['oldModel'];

        $parkingPassLogRepository = app(ParkingPassLogRepository::class);

        $changedData = $this->getChangedData($parkingPass, $oldParkingPass);

        // log changes
        if (!empty($changedData)) {
            $changedData['propertyId'] = $parkingPass->propertyId;
            $changedData['passId'] = $parkingPass->id;
            $changedData['spaceId'] = $parkingPass->spaceId;
            $changedData['event'] = 'updated';

            $parkingPassLogRepository->save($changedData);
        }



    }
}
