<?php

namespace App\Listeners\EventSignup;

use App\Events\EventSignup\EventSignupUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEventSignupCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EventSignupUpdatedEvent  $event
     * @return void
     */
    public function handle(EventSignupUpdatedEvent $event)
    {
        $eventSignup = $event->eventSignup;
        $eventOptions = $event->options;
    }
}
