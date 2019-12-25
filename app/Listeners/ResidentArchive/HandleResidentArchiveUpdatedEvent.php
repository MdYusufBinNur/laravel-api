<?php

namespace App\Listeners\ResidentArchive;

use App\Events\ResidentArchive\ResidentArchiveUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleResidentArchiveUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ResidentArchiveUpdatedEvent  $event
     * @return void
     */
    public function handle(ResidentArchiveUpdatedEvent $event)
    {
        $residentArchive = $event->residentArchive;
        $eventOptions = $event->options;
        $oldResidentArchive = $eventOptions['oldModel'];
    }
}
