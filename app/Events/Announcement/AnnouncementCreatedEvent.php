<?php

namespace App\Events\Announcement;

use App\DbModels\Announcement;
use Illuminate\Queue\SerializesModels;

class AnnouncementCreatedEvent
{
    use SerializesModels;

    /**
     * @var Announcement
     */
    public $announcement;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Announcement $announcement
     * @param array $options
     */
    public function __construct(Announcement $announcement, array $options = [ ])
    {
        $this->announcement = $announcement;
        $this->options = $options;
    }
}
