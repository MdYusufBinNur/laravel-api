<?php

namespace App\Events\Visitor;

use App\DbModels\Visitor;
use Illuminate\Queue\SerializesModels;

class VisitorCreatedEvent
{
    use SerializesModels;

    /**
     * @var Visitor
     */
    public $visitor;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Visitor $visitor
     * @param array $options
     * @return void
     */
    public function __construct(Visitor $visitor, array $options = [])
    {
        $this->visitor = $visitor;
        $this->options = $options;
    }
}
