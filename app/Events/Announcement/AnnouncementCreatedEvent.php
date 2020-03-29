<?php

namespace App\Events\Announcement;

use App\DbModels\Announcement;
use App\Http\Resources\AnnouncementResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class AnnouncementCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var Announcement
     */
    public $announcement;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Announcement $announcement
     * @param array $options
     */
    public function __construct(Announcement $announcement, array $options = [ ])
    {
        $this->announcement = $announcement;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $channels[] = new PrivateChannel('PROPERTY.' . $this->announcement->propertyId);

        return $channels;

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['announcement'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'announcement' => new AnnouncementResource($this->announcement),
            'options' => $this->options['request']
        ];
    }
}
