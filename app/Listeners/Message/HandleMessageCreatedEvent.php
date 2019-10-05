<?php

namespace App\Listeners\Message;

use App\Events\Message\MessageCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Message\SendMessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleMessageCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param MessageCreatedEvent $event
     * @return void
     */
    public function handle(MessageCreatedEvent $event)
    {
        $message = $event->message;
        $eventOptions = $event->options;

        if ($message->emailNotification) {
            $property = $message->property;
            $fromUser = $message->fromUser;
            $messageText = $message->scopeLastMessagePostOfTheUser($fromUser->id)->first()->text;
            foreach ($message->toMessageUsers as $messageUser) {
                $toUser = $messageUser->user;
                Mail::to($toUser->email)->send(new SendMessageNotification($message, $property, $fromUser, $toUser, $messageText));
            }
        }

    }
}
