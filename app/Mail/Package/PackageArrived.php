<?php

namespace App\Mail\Package;

use App\DbModels\Package;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PackageArrived extends Mailable
{
    use SerializesModels;

    /**
     * @var Package
     */
    public $package;

    /**
     * Create a new message instance.
     *
     * @param Package $package
     * @return void
     */
    public function __construct(Package $package)
    {
        $this->package = $package;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $property = $this->package->property;
        $resident = $this->package->resident;
        $unit = $this->package->unit;

        return $this->subject("New Package Arrived")->view('package.arrived.created')
            ->with(['package' => $this->package, 'resident' => $resident, 'property' => $property, 'unit' => $unit]);
    }
}
