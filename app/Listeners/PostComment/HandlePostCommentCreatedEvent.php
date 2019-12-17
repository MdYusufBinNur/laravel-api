<?php

namespace App\Listeners\PostComment;

use App\DbModels\UserNotificationType;
use App\Events\PostComment\PostCommentCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostCommentCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param PostCommentCreatedEvent $event
     * @return void
     */
    public function handle(PostCommentCreatedEvent $event)
    {
        $postComment = $event->postComment;
        $eventOptions = $event->options;

        $postCreatorId = $postComment->getPostCreatorUserId();
        $postCommentUserIds = $postComment->getPostCommentUserIds();
        if ($postCreatorId[0] === $postComment->createdByUserId){
            $toUserIds = array_diff($postCommentUserIds, $postCreatorId);
        } else {
            $postCommentUserIds = in_array($postCreatorId[0], $postCommentUserIds) ? $postCommentUserIds : array_merge($postCommentUserIds, $postCreatorId);
            $toUserIds = array_diff($postCommentUserIds, [$postComment->createdByUserId]);
        }

        $totalPostCommentUser = count(array_diff($postCommentUserIds, $postCreatorId));

        $userNotificationRepository = app(UserNotificationRepository::class);
        foreach ($toUserIds as $toUserId) {
            if ($postCreatorId[0] === $toUserId){
                $additionalMessage = $totalPostCommentUser > 1 ? 'and '. $totalPostCommentUser. ' others' : '';
                $message = $additionalMessage .' commented on your post';
            } else if ($postCreatorId[0] !== $toUserId) {
                $message = 'commented on a post that you`re following on';
            }
            $userNotificationRepository->save([
                'fromUserId' => $postComment->createdByUserId,
                'toUserId' => $toUserId,
                'userNotificationTypeId' => UserNotificationType::POST_COMMENT['id'],
                'resourceId' => $postComment->postId,
                'message' => $message,
            ]);
        }
    }
}
