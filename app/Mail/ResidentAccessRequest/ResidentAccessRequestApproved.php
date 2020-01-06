<?php

namespace App\Mail\ResidentAccessRequest;

use App\DbModels\ResidentAccessRequest;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResidentAccessRequestApproved extends Mailable
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
        $propertyLink = $property->getLoginLink();
        $completeRegistrationLink = 'https://'. $propertyLink. '/registration';

        return $this->subject("Approved! Welcome to {$property->title} community")->view('resident.approved-request.index')
            ->with(['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'completeRegistrationLink' => $completeRegistrationLink, 'unit' => $unit]);
    }
}
