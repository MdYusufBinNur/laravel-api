<?php

namespace App\Events\ParkingPass;

use App\DbModels\ParkingPass;
use App\Http\Resources\ParkingPassResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ParkingPassCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var ParkingPass
     */
    public $parkingPass;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param ParkingPass $parkingPass
     * @param array $options
     * @return void
     */
    public function __construct(ParkingPass $parkingPass, array $options = [])
    {
        $this->parkingPass = $parkingPass;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $channels[] = new PrivateChannel('PROPERTY.STAFF.' . $this->parkingPass->propertyId);

        return $channels;

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['newParkingPass'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        request()->merge(['include' => 'pp.space', 'pp.unit', 'pp.createdByUser', 'pp.releasedByUser']);
        return [
            'parkingPass' => new ParkingPassResource($this->parkingPass)
        ];
    }
}
