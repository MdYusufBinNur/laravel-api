<?php

namespace App\Listeners\VisitorArchive;

use App\Events\VisitorArchive\VisitorArchiveCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleVisitorArchiveCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  VisitorArchiveCreatedEvent  $event
     * @return void
     */
    public function handle(VisitorArchiveCreatedEvent $event)
    {
        $visitorArchive = $event->visitorArchive;
        $eventOptions = $event->options;
    }
}
