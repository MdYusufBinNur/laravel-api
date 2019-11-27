<?php

namespace App\Listeners\LdsSlideProperty;

use App\Events\LdsSlideProperty\LdsSlidePropertyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLdsSlidePropertyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  LdsSlidePropertyUpdatedEvent  $event
     * @return void
     */
    public function handle(LdsSlidePropertyUpdatedEvent $event)
    {
        $ldsSlideProperty = $event->ldsSlideProperty;
        $eventOptions = $event->options;
        $oldLdsSlideProperty = $eventOptions['oldModel'];
    }
}
