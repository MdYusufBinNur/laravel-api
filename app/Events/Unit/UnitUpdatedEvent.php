<?php

namespace App\Events\Unit;

use App\DbModels\Unit;
use Illuminate\Queue\SerializesModels;

class UnitUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Unit
     */
    public $unit;

    /**
     * Create a new event instance.
     *
     * @param Unit $unit
     * @param array $options
     */
    public function __construct(Unit $unit, array $options = [])
    {
        $this->unit = $unit;
        $this->options = $options;
    }
}
