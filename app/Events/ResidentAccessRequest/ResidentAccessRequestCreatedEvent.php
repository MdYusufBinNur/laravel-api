<?php

namespace App\Events\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use Illuminate\Queue\SerializesModels;

class ResidentAccessRequestCreatedEvent
{
    use SerializesModels;

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
