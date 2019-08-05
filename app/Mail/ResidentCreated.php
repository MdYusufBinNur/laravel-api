<?php

namespace App\Mail;

use App\DbModels\Resident;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResidentCreated extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this->view('resident.created')
            ->with(['resident' => $this->resident]);
    }
}
