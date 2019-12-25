<?php

namespace App\Events\LdsBlacklistUnit;

use App\DbModels\LdsBlacklistUnit;
use Illuminate\Queue\SerializesModels;

class LdsBlacklistUnitCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var LdsBlacklistUnit
     */
    public $ldsBlacklistUnit;

    /**
     * Create a new event instance.
     *
     * @param LdsBlacklistUnit $ldsBlacklistUnit
     * @param array $options
     */
    public function __construct(LdsBlacklistUnit $ldsBlacklistUnit, array $options = [])
    {
        $this->ldsBlacklistUnit = $ldsBlacklistUnit;
        $this->options = $options;
    }
}
