<?php

namespace App\Events\VisitorArchive;

use App\DbModels\VisitorArchive;
use Illuminate\Queue\SerializesModels;

class VisitorArchiveUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var VisitorArchive
     */
    public $visitorArchive;

    /**
     * Create a new event instance.
     *
     * @param VisitorArchive $visitorArchive
     * @param array $options
     */
    public function __construct(VisitorArchive $visitorArchive, array $options = [])
    {
        $this->visitorArchive = $visitorArchive;
        $this->options = $options;
    }
}
