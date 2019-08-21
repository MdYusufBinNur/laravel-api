<?php

namespace App\Events\ResidentAccessRequest;

use App\DbModels\Resident;
use App\DbModels\ResidentAccessRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResidentAccessRequestUpdatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ResidentAccessRequest
     */
    public $residentAccessRequest;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param ResidentAccessRequest $residentAccessRequest
     * @param array $options
     * @return void
     */
    public function __construct(ResidentAccessRequest $residentAccessRequest, array $options = [])
    {
        $this->residentAccessRequest = $residentAccessRequest;
        $this->options = $options;
    }
}
