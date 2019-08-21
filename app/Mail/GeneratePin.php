<?php

namespace App\Mail;

use App\DbModels\Resident;
use App\DbModels\ResidentAccessRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeneratePin extends Mailable implements ShouldQueue
{
    use SerializesModels;

    /**
     * @var ResidentAccessRequest
     */
    public $residentAccessRequest;

    /**
     * Create a new message instance.
     *
     * @param ResidentAccessRequest $residentAccessRequest
     * @return void
     */
    public function __construct(ResidentAccessRequest $residentAccessRequest)
    {
        $this->residentAccessRequest = $residentAccessRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $residentAccessRequest = $this->residentAccessRequest;
        $property = $this->residentAccessRequest->property;
        $unit = $this->residentAccessRequest->unit;

        return $this->subject("Welcome to {$property->title} community")->view('resident.access-request.generate-pin')
            ->with(['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'unit' => $unit]);
    }
}
