<?php

namespace App\Mail\PackageArchive;

use App\DbModels\PackageArchive;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PackageSignOut extends Mailable
{
    use SerializesModels;

    /**
     * @var PackageArchive
     */
    public $packageArchive;

    /**
     * Create a new message instance.
     *
     * @param PackageArchive $packageArchive
     * @return void
     */
    public function __construct(PackageArchive $packageArchive)
    {
        $this->packageArchive = $packageArchive;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $package = $this->packageArchive->package;
        $property = $package->property;
        $resident = $package->resident;
        $unit = $package->unit;

        return $this->subject("Your Package Just Signed Out!")->view('package.sign-out')
            ->with(['packageArchive' => $this->packageArchive, 'package' => $package, 'resident' => $resident, 'property' => $property, 'unit' => $unit]);
    }
}
