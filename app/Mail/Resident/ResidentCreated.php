<?php

namespace App\Mail\Resident;

use App\DbModels\Resident;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResidentCreated extends Mailable
{
    use SerializesModels;

    /**
     * @var Resident
     */
    public $resident;

    /**
     * Create a new message instance.
     *
     * @param Resident $resident
     * @return void
     */
    public function __construct(Resident $resident)
    {
        $this->resident = $resident;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('resident.index')
            ->with(['resident' => $this->resident]);
    }
}
