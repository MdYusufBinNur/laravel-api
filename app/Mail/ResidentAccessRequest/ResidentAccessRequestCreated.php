<?php

namespace App\Mail\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResidentAccessRequestCreated extends Mailable
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

        return $this->subject("Welcome to {$property->title} community")->view('layouts.main')
            ->with(['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'unit' => $unit]);
    }
}
