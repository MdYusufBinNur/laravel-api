<?php

namespace App\Events\PostComment;

use App\DbModels\PostComment;
use App\Http\Resources\PostCommentResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class PostCommentCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var PostComment
     */
    public $postComment;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param PostComment $postComment
     * @param array $options
     * @return void
     */
    public function __construct(PostComment $postComment, array $options = [])
    {
        $this->postComment = $postComment;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $channels[] = new PrivateChannel('PROPERTY.' . $this->postComment->post->propertyId);

        return $channels;

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['newComment'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        request()->merge(['include' => 'pc.createdByUser,pc.commentOnPostUserIds,user.profilePic,image.avatar']);

        return [
            'comment' => new PostCommentResource($this->postComment),
            'options' => $this->options['request']
        ];
    }
}
