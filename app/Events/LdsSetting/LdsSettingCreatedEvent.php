<?php

namespace App\Events\LdsSetting;

use App\DbModels\LdsSetting;
use Illuminate\Queue\SerializesModels;

class LdsSettingCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var LdsSetting
     */
    public $ldsSetting;

    /**
     * Create a new event instance.
     *
     * @param LdsSetting $ldsSetting
     * @param array $options
     */
    public function __construct(LdsSetting $ldsSetting, array $options = [])
    {
        $this->ldsSetting = $ldsSetting;
        $this->options = $options;
    }
}
