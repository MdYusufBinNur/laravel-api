<?php

namespace App\Events\FdiGuestType;

use App\DbModels\FdiGuestType;
use Illuminate\Queue\SerializesModels;

class FdiGuestTypeCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var FdiGuestType
     */
    public $fdiGuestType;

    /**
     * Create a new event instance.
     *
     * @param FdiGuestType $fdiGuestType
     * @param array $options
     */
    public function __construct(FdiGuestType $fdiGuestType, array $options = [])
    {
        $this->fdiGuestType = $fdiGuestType;
        $this->options = $options;
    }
}
