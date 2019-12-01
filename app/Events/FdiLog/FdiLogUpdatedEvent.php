<?php

namespace App\Events\FdiLog;

use App\DbModels\FdiLog;
use Illuminate\Queue\SerializesModels;

class FdiLogUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var FdiLog
     */
    public $fdiLog;

    /**
     * Create a new event instance.
     *
     * @param FdiLog $fdiLog
     * @param array $options
     */
    public function __construct(FdiLog $fdiLog, array $options = [])
    {
        $this->fdiLog = $fdiLog;
        $this->options = $options;
    }
}
