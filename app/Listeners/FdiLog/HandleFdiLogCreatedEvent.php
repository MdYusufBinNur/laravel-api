<?php

namespace App\Listeners\FdiLog;

use App\Events\FdiLog\FdiLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFdiLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  FdiLogCreatedEvent  $event
     * @return void
     */
    public function handle(FdiLogCreatedEvent $event)
    {
        $fdiLog = $event->fdiLog;
        $eventOptions = $event->options;
    }
}
