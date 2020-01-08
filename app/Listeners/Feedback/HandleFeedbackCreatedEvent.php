<?php

namespace App\Listeners\Feedback;

use App\Events\Feedback\FeedbackCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Services\Ticket\TicketService\FreshDesk;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFeedbackCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param FeedbackCreatedEvent $event
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(FeedbackCreatedEvent $event)
    {
        $feedback = $event->feedback;
        $eventOptions = $event->options;
        $userData = $feedback->createdByUser;

        $data = [
            'name' => $userData->name,
            'phone' => $userData->phone,
            'requester_id' => $userData->id,
            'email' => $userData->email,
            'subject' => 'User Feedback',
            'description' => $feedback->feedbackText,
            'priority' => 2,
            'status' => 2,
        ];

        app()->make(FreshDesk::class)->store($data);
    }
}
