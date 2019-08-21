<?php

namespace App\Events;

use App\DbModels\Resident;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResidentCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Resident
     */
    public $resident;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Resident $resident
     * @param array $options
     * @return void
     */
    public function __construct(Resident $resident, array $options = [])
    {
        $this->resident = $resident;
        $this->options = $options;
    }
}
