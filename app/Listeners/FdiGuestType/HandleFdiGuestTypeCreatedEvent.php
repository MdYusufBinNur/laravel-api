<?php

namespace App\Listeners\FdiGuestType;

use App\Events\FdiGuestType\FdiGuestTypeCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFdiGuestTypeCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  FdiGuestTypeCreatedEvent  $event
     * @return void
     */
    public function handle(FdiGuestTypeCreatedEvent $event)
    {
        $fdiGuestType = $event->fdiGuestType;
        $eventOptions = $event->options;
    }
}
