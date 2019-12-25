<?php

namespace App\Events\PostApprovalArchive;

use App\DbModels\PostApprovalArchive;
use Illuminate\Queue\SerializesModels;

class PostApprovalArchiveCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PostApprovalArchive
     */
    public $postApprovalArchive;

    /**
     * Create a new event instance.
     *
     * @param PostApprovalArchive $postApprovalArchive
     * @param array $options
     */
    public function __construct(PostApprovalArchive $postApprovalArchive, array $options = [])
    {
        $this->postApprovalArchive = $postApprovalArchive;
        $this->options = $options;
    }
}
