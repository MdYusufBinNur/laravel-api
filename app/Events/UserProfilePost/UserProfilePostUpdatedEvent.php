<?php

namespace App\Events\UserProfilePost;

use App\DbModels\UserProfilePost;
use Illuminate\Queue\SerializesModels;

class UserProfilePostUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserProfilePost
     */
    public $userProfilePost;

    /**
     * Create a new event instance.
     *
     * @param UserProfilePost $userProfilePost
     * @param array $options
     */
    public function __construct(UserProfilePost $userProfilePost, array $options = [])
    {
        $this->userProfilePost = $userProfilePost;
        $this->options = $options;
    }
}
