<?php

namespace App\Listeners\LdsSlide;

use App\Events\LdsSlide\LdsSlideUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLdsSlideUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  LdsSlideUpdatedEvent  $event
     * @return void
     */
    public function handle(LdsSlideUpdatedEvent $event)
    {
        $ldsSlide = $event->ldsSlide;
        $eventOptions = $event->options;
        $oldLdsSlide = $eventOptions['oldModel'];
    }
}
