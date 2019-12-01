<?php

namespace App\Events\ResidentEmergency;

use App\DbModels\ResidentEmergency;
use Illuminate\Queue\SerializesModels;

class ResidentEmergencyUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ResidentEmergency
     */
    public $residentEmergency;

    /**
     * Create a new event instance.
     *
     * @param ResidentEmergency $residentEmergency
     * @param array $options
     */
    public function __construct(ResidentEmergency $residentEmergency, array $options = [])
    {
        $this->residentEmergency = $residentEmergency;
        $this->options = $options;
    }
}
