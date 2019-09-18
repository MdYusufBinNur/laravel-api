<?php

namespace App\Listeners\Visitor;

use App\Events\Package\PackageCreatedEvent;
use App\Events\Visitor\VisitorCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Visitor\VisitorArrived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleVisitorCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param VisitorCreatedEvent $event
     * @return void
     */
    public function handle(VisitorCreatedEvent $event)
    {
        $visitor = $event->visitor;
        $eventOptions = $event->options;

        foreach ($visitor->unit->residents as $resident) {
            Mail::to($resident->user->email)->send(new VisitorArrived($visitor));
        }
    }
}
