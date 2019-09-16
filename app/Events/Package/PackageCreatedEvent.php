<?php

namespace App\Events\Package;

use App\DbModels\Package;
use Illuminate\Queue\SerializesModels;

class PackageCreatedEvent
{
    use SerializesModels;

    /**
     * @var Package
     */
    public $package;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Package $package
     * @param array $options
     * @return void
     */
    public function __construct(Package $package, array $options = [])
    {
        $this->package = $package;
        $this->options = $options;
    }
}
