<?php

namespace App\Listeners\LdsSlideProperty;

use App\Events\LdsSlideProperty\LdsSlidePropertyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLdsSlidePropertyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  LdsSlidePropertyCreatedEvent  $event
     * @return void
     */
    public function handle(LdsSlidePropertyCreatedEvent $event)
    {
        $ldsSlideProperty = $event->ldsSlideProperty;
        $eventOptions = $event->options;
    }
}
