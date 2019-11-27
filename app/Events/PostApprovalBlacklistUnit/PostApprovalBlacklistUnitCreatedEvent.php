<?php

namespace App\Events\PostApprovalBlacklistUnit;

use App\DbModels\PostApprovalBlacklistUnit;
use Illuminate\Queue\SerializesModels;

class PostApprovalBlacklistUnitCreatedEvent
{

    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PostApprovalBlacklistUnit
     */
    public $postApprovalBlacklistUnit;

    /**
     * Create a new event instance.
     *
     * @param PostApprovalBlacklistUnit $postApprovalBlacklistUnit
     * @param array $options
     */
    public function __construct(PostApprovalBlacklistUnit $postApprovalBlacklistUnit, array $options = [])
    {
        $this->postApprovalBlacklistUnit = $postApprovalBlacklistUnit;
        $this->options = $options;
    }
}
