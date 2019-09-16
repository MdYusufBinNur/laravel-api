<?php

namespace App\Events\PackageArchive;

use App\DbModels\PackageArchive;
use Illuminate\Queue\SerializesModels;

class PackageArchivedCreatedEvent
{
    use SerializesModels;

    /**
     * @var PackageArchive
     */
    public $packageArchive;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param PackageArchive $packageArchive
     * @param array $options
     * @return void
     */
    public function __construct(PackageArchive $packageArchive, array $options = [])
    {
        $this->packageArchive = $packageArchive;
        $this->options = $options;
    }
}
