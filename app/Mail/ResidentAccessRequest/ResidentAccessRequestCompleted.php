<?php

namespace App\Mail\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResidentAccessRequestCompleted extends Mailable
{
    use  SerializesModels;

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

        return $this->subject("Completed! Welcome to {$property->title} community")->view('resident.completed-request.index')
            ->with(['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'unit' => $unit]);
    }
}