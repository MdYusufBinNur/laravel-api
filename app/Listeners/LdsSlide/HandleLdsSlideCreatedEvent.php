<?php

namespace App\Listeners\LdsSlide;

use App\Events\LdsSlide\LdsSlideCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLdsSlideCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  LdsSlideCreatedEvent  $event
     * @return void
     */
    public function handle(LdsSlideCreatedEvent $event)
    {
        $ldsSlide = $event->ldsSlide;
        $eventOptions = $event->options;
        $oldLdsSlide = $eventOptions['oldModel'];
    }
}
