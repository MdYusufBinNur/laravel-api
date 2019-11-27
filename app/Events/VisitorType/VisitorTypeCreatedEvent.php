<?php

namespace App\Events\VisitorType;

use App\DbModels\VisitorType;
use Illuminate\Queue\SerializesModels;

class VisitorTypeCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var VisitorType
     */
    public $visitorType;

    /**
     * Create a new event instance.
     *
     * @param VisitorType $visitorType
     * @param array $options
     */
    public function __construct(VisitorType $visitorType, array $options = [])
    {
        $this->visitorType = $visitorType;
        $this->options = $options;
    }
}
