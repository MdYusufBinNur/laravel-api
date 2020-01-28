<?php

namespace App\Listeners\Message;

use App\DbModels\UserNotificationType;
use App\Events\Message\MessageCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Message\SendMessageNotification;
use App\Repositories\Contracts\UserNotificationRepository;
use App\Repositories\Contracts\UserNotificationTypeRepository;
use Illuminate\Broadcasting\PrivateChannel;
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

        $property = $message->property;
        $fromUser = $message->fromUser;
        $messageUser = $message->messageUsers->toArray();

        if ($message->emailNotification) {
            $messageText = $message->scopeLastMessagePostOfTheUser($fromUser->id)->first()->text;
            foreach ($message->toMessageUsers as $messageUser) {
                $toUser = $messageUser->user;
                Mail::to($toUser->email)->send(new SendMessageNotification($message, $property, $fromUser, $toUser, $messageText));
            }
        }

        $userNotificationRepository = app(UserNotificationRepository::class);
        if ($message->isGroupMessage) {
            $toUserIds = explode(',', $message->group);
        } else {
            $toUserIds = [$message->toUserId];
        }

        foreach ($toUserIds as $toUserId) {
            $resource = array_filter(
                $messageUser,
                function ($e) use (&$toUserId) {
                    return $e['userId'] ==  $toUserId;
                }
            );
            $userNotificationRepository->save([
                'fromUserId' => $message->fromUserId,
                'toUserId' => $toUserId,
                'userNotificationTypeId' => UserNotificationType::MESSAGE['id'],
                'resourceId' => $resource[0]['id'],
                'message' => 'New message from ' . $fromUser->name,
            ]);
        }
    }
}
