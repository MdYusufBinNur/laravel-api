<?php

namespace App\Listeners\EventSignup;

use App\Events\EventSignup\EventSignupCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEventSignupUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EventSignupCreatedEvent  $event
     * @return void
     */
    public function handle(EventSignupCreatedEvent $event)
    {
        $eventSignup = $event->eventSignup;
        $eventOptions = $event->options;
        $oldEventSignup = $eventOptions['oldModel'];
    }
}
