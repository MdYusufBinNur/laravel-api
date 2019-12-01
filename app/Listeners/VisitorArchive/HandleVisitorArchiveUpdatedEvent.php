<?php

namespace App\Listeners\VisitorArchive;

use App\Events\VisitorArchive\VisitorArchiveUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleVisitorArchiveUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  VisitorArchiveUpdatedEvent  $event
     * @return void
     */
    public function handle(VisitorArchiveUpdatedEvent $event)
    {
        $visitorArchive = $event->visitorArchive;
        $eventOptions = $event->options;
        $oldVisitorArchive = $eventOptions['oldModel'];
    }
}
