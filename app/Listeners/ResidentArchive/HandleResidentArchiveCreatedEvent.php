<?php

namespace App\Listeners\ResidentArchive;

use App\Events\ResidentArchive\ResidentArchiveCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleResidentArchiveCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ResidentArchiveCreatedEvent  $event
     * @return void
     */
    public function handle(ResidentArchiveCreatedEvent $event)
    {
        $residentArchive = $event->residentArchive;
        $eventOptions = $event->options;
    }
}
