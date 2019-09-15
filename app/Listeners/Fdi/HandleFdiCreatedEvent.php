<?php

namespace App\Listeners\Fdi;

use App\DbModels\FdiLog;
use App\Events\Fdi\FdiCreatedEvent;
use App\Events\ServiceRequest\ServiceRequestCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\FdiLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFdiCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param ServiceRequestCreatedEvent $event
     * @return void
     */
    public function handle(FdiCreatedEvent $event)
    {
        $fdi = $event->fdi;
        $eventOptions = $event->options;

        $fdiLogRepository = app(FdiLogRepository::class);

        $fdiLogRepository->save([
            'fdiId' => $fdi->id,
            'userId' => $fdi->createdByUserId,
            'type' => FdiLog::TYPE_ADD,
            'text' => 'Added'
        ]);


    }
}
