<?php

namespace App\Events\PackageType;

use App\DbModels\PackageType;
use Illuminate\Queue\SerializesModels;

class PackageTypeCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PackageType
     */
    public $packageType;

    /**
     * Create a new event instance.
     *
     * @param PackageType $packageType
     * @param array $options
     */
    public function __construct(PackageType $packageType, array $options = [])
    {
        $this->packageType = $packageType;
        $this->options = $options;
    }
}
