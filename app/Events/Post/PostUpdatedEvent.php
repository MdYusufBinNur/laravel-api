<?php

namespace App\Events\Post;

use App\DbModels\Post;
use Illuminate\Queue\SerializesModels;

class PostUpdatedEvent
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
}
