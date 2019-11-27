<?php

namespace App\Events\ResidentArchive;

use App\DbModels\ResidentArchive;
use Illuminate\Queue\SerializesModels;

class ResidentArchiveUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ResidentArchive
     */
    public $residentArchive;

    /**
     * Create a new event instance.
     *
     * @param ResidentArchive $residentArchive
     * @param array $options
     */
    public function __construct(ResidentArchive $residentArchive, array $options = [])
    {
        $this->residentArchive = $residentArchive;
        $this->options = $options;
    }
}
