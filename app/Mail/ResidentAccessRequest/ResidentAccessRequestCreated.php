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
     * @var bool
     */
    public $toStaff;

    /**
     * Create a new message instance.
     *
     * @param ResidentAccessRequest $residentAccessRequest
     * @param bool $toStaff
     */
    public function __construct(ResidentAccessRequest $residentAccessRequest, $toStaff = false)
    {
        $this->residentAccessRequest = $residentAccessRequest;
        $this->toStaff = $toStaff;
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
        $subject = $this->toStaff ? 'A New Registration Request to your property' : ("Received! Registration request to {$property->title} community");

        return $this->subject($subject)->view('resident.access-request.index')
            ->with(['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'unit' => $unit, 'toStaff' => $this->toStaff]);
    }
}
