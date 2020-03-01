<?php

namespace App\Events\StaffTimeClock;

use App\DbModels\StaffTimeClock;
use App\Http\Resources\StaffTimeClockResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class StaffTimeClockCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var StaffTimeClock
     */
    public $staffTimeClock;

    /**
     * Create a new event instance.
     *
     * @param StaffTimeClock $staffTimeClock
     * @param array $options
     */
    public function __construct(StaffTimeClock $staffTimeClock, array $options = [])
    {
        $this->staffTimeClock = $staffTimeClock;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $channels[] = new PrivateChannel('PROPERTY.STAFF.' . $this->staffTimeClock->propertyId);

        return $channels;

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['newStaffTimeClock'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        request()->merge(['include' => 'stc.manager,stc.clockInPhoto,staff.user,user.profilePic']);
        return [
            'staffTimeClock' => new StaffTimeClockResource($this->staffTimeClock)
        ];
    }
}
