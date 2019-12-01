<?php

namespace App\Events\Module;

use App\DbModels\Module;
use Illuminate\Queue\SerializesModels;

class ModuleCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Module
     */
    public $module;

    /**
     * Create a new event instance.
     *
     * @param Module $module
     * @param array $options
     */
    public function __construct(Module $module, array $options = [])
    {
        $this->module = $module;
        $this->options = $options;
    }
}
