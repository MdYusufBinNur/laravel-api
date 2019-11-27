<?php

namespace App\Events\ModuleOption;

use App\DbModels\ModuleOption;
use Illuminate\Queue\SerializesModels;

class ModuleOptionUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ModuleOption
     */
    public $moduleOption;

    /**
     * Create a new event instance.
     *
     * @param ModuleOption $moduleOption
     * @param array $options
     */
    public function __construct(ModuleOption $moduleOption, array $options = [])
    {
        $this->moduleOption = $moduleOption;
        $this->options = $options;
    }
}
