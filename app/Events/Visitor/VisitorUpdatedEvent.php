<?php

namespace App\Events\Visitor;

use App\DbModels\Visitor;
use Illuminate\Queue\SerializesModels;

class VisitorUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Visitor
     */
    public $visitor;

    /**
     * Create a new event instance.
     *
     * @param Visitor $visitor
     * @param array $options
     */
    public function __construct(Visitor $visitor, array $options = [])
    {
        $this->visitor = $visitor;
        $this->options = $options;
    }
}
