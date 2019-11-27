<?php

namespace App\Listeners\FdiGuestType;

use App\Events\FdiGuestType\FdiGuestTypeUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFdiGuestTypeUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  FdiGuestTypeUpdatedEvent  $event
     * @return void
     */
    public function handle(FdiGuestTypeUpdatedEvent $event)
    {
        $fdiGuestType = $event->fdiGuestType;
        $eventOptions = $event->options;
        $oldFdiGuestType = $eventOptions['oldModel'];
    }
}
