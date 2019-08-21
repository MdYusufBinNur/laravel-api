<?php

namespace App\Events;

use App\DbModels\Resident;
use App\DbModels\ResidentAccessRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ResidentAccessRequestCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ResidentAccessRequest
     */
    public $residentAccessRequest;

    /**
     * Create a new event instance.
     *
     * @param ResidentAccessRequest $residentAccessRequest
     * @return void
     */
    public function __construct(ResidentAccessRequest $residentAccessRequest)
    {
        $this->residentAccessRequest = $residentAccessRequest;
    }
}
