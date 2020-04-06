<?php

namespace App\Mail\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResidentAccessRequestToStaffCreated extends Mailable
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
        $subject = 'A New Registration Request to your property';

        return $this->subject($subject)->view('resident.access-request-to-staff.index')
            ->with(['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'unit' => $unit]);
    }
}
