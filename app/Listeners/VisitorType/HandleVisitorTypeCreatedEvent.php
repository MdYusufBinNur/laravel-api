<?php

namespace App\Listeners\VisitorType;

use App\Events\VisitorType\VisitorTypeCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleVisitorTypeCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  VisitorTypeCreatedEvent  $event
     * @return void
     */
    public function handle(VisitorTypeCreatedEvent $event)
    {
        $visitorType = $event->visitorType;
        $eventOptions = $event->options;
    }
}
