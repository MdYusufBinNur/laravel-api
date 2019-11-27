<?php

namespace App\Events\ModuleOptionProperty;

use App\DbModels\ModuleOptionProperty;
use Illuminate\Queue\SerializesModels;

class ModuleOptionPropertyCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ModuleOptionProperty
     */
    public $moduleOptionProperty;

    /**
     * Create a new event instance.
     *
     * @param ModuleOptionProperty $moduleOptionProperty
     * @param array $options
     */
    public function __construct(ModuleOptionProperty $moduleOptionProperty, array $options = [])
    {
        $this->moduleOptionProperty = $moduleOptionProperty;
        $this->options = $options;
    }
}
