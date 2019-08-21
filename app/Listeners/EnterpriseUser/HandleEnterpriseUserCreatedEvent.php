<?php

namespace App\Listeners\EnterpriseUser;

use App\Events\EnterpriseUser\EnterpriseUserCreatedEvent;
use App\Mail\EnterpriseUser\EnterpriseUserCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleEnterpriseUserCreatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param EnterpriseUserCreatedEvent $event
     * @return void
     */
    public function handle(EnterpriseUserCreatedEvent $event)
    {
        $enterpriseUser = $event->enterpriseUser;
        $toEmail = $enterpriseUser->contactEmail ?? $enterpriseUser->user->email;

        Mail::to($toEmail)->send(new EnterpriseUserCreatedMail($event->enterpriseUser));
    }
}
