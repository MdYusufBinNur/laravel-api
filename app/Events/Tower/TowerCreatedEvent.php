<?php

namespace App\Events\Tower;

use App\DbModels\Tower;
use Illuminate\Queue\SerializesModels;

class TowerCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Tower
     */
    public $tower;

    /**
     * Create a new event instance.
     *
     * @param Tower $tower
     * @param array $options
     */
    public function __construct(Tower $tower, array $options = [])
    {
        $this->tower = $tower;
        $this->options = $options;
    }
}
