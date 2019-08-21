<?php

namespace App\Events\Resident;

use App\DbModels\Resident;
use Illuminate\Queue\SerializesModels;

class ResidentCreatedEvent
{
    use SerializesModels;

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
