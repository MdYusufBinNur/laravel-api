<?php

namespace App\Listeners\Visitor;

use App\Events\Visitor\VisitorUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleVisitorUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  VisitorUpdatedEvent  $event
     * @return void
     */
    public function handle(VisitorUpdatedEvent $event)
    {
        $visitor = $event->visitor;
        $eventOptions = $event->options;
        $oldVisitor = $eventOptions['oldModel'];
    }
}
