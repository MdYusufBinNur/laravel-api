<?php

namespace App\Events\UserNotification;

use App\DbModels\Message;
use App\DbModels\UserNotification;
use App\Http\Resources\UserNotificationResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class UserNotificationCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var Message
     */
    public $userNotification;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param UserNotification $userNotification
     * @param array $options
     * @return void
     */
    public function __construct(UserNotification $userNotification, array $options = [])
    {
        $this->userNotification = $userNotification;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return new PrivateChannel('USER.' . $this->userNotification->toUserId);

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['newNotification'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'userNotification' => new UserNotificationResource($this->userNotification)
        ];
    }

}
