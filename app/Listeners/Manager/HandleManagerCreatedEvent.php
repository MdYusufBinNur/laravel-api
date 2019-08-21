<?php

namespace App\Listeners\Manager;

use App\Events\Manager\ManagerCreatedEvent;
use App\Mail\Manager\ManagerCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleManagerCreatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ManagerCreatedEvent $event
     * @return void
     */
    public function handle(ManagerCreatedEvent $event)
    {
        $manager = $event->manager;
        $toEmail = $manager->contactEmail ?? $manager->user->email;

        Mail::to($toEmail)->send(new ManagerCreatedMail($event->manager));
    }
}
