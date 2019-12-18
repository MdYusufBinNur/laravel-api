<?php

namespace App\Listeners\Post;

use App\DbModels\Fdi;
use App\DbModels\FdiLog;
use App\DbModels\UserNotificationType;
use App\Events\Fdi\FdiCreatedEvent;
use App\Events\Fdi\FdiUpdatedEvent;
use App\Events\Post\PostUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\FdiLogRepository;
use App\Repositories\Contracts\PostApprovalArchiveRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param PostUpdatedEvent $event
     * @return void
     */
    public function handle(PostUpdatedEvent $event)
    {
        $post = $event->post;
        $eventOptions = $event->options;
        $oldPost = $eventOptions['oldModel'];

        $hasStatusChanged = $this->hasAFieldValueChanged($post, $oldPost, 'status');

        if ($hasStatusChanged) {
            $postApprovalArchiveRepository = app(PostApprovalArchiveRepository::class);
            $postApprovalArchiveRepository->save([
                'postId' => $post->id,
                'createdByUserId' => $eventOptions['request']['loggedInUserId'],
                'status' => $post->status,
                'reason' => $eventOptions['request']['reason'] ?? ''
            ]);
        }

        if ($eventOptions['request']['likeChanged']){
            $postCreatorId = $post->createdByUserId;
            $totalLikes = $post->likeCount;
            $loggedInUserId = $eventOptions['request']['loggedInUserId'];

            $additionalMessage = $totalLikes > 1 ? ', and '. $totalLikes. ' others' : '';
            $message = $additionalMessage .' liked your post';

            $userNotificationRepository = app(UserNotificationRepository::class);
            $userNotificationRepository->save([
                'fromUserId' => $loggedInUserId,
                'toUserId' => $postCreatorId,
                'userNotificationTypeId' => UserNotificationType::POST_UPDATE['id'],
                'resourceId' => $post->id,
                'message' => $message,
            ]);
        }
    }
}
