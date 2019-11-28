<?php

namespace App\Listeners\VisitorType;

use App\Events\VisitorType\VisitorTypeUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleVisitorTypeUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  VisitorTypeUpdatedEvent  $event
     * @return void
     */
    public function handle(VisitorTypeUpdatedEvent $event)
    {
        $visitorType = $event->visitorType;
        $eventOptions = $event->options;
        $oldVisitorType= $eventOptions['oldModel'];
    }
}
