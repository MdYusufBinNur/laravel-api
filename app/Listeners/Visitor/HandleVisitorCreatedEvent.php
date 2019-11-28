<?php

namespace App\Listeners\Visitor;

use App\Events\Visitor\VisitorCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleVisitorCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  VisitorCreatedEvent  $event
     * @return void
     */
    public function handle(VisitorCreatedEvent $event)
    {
        $visitor = $event->visitor;
        $eventOptions = $event->options;
    }
}
