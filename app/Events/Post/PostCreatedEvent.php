<?php

namespace App\Events\Post;

use App\DbModels\Post;
use App\Http\Resources\PostResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class PostCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var Post
     */
    public $post;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Post $post
     * @param array $options
     * @return void
     */
    public function __construct(Post $post, array $options = [])
    {
        $this->post = $post;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $channels[] = new PrivateChannel('PROPERTY.' . $this->post->propertyId);

        return $channels;

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['newPost'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        request()->merge(['include' => 'post.createdByUser,post.details,post.attachments,post.commentsCount,user.profilePic,image.avatar']);
        return [
            'post' => new PostResource($this->post)
        ];
    }
}
