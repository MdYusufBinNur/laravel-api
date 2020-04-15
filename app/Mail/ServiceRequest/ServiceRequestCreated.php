<?php

namespace App\Mail\ServiceRequest;

use App\DbModels\ServiceRequest;
use App\DbModels\Unit;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceRequestCreated extends Mailable
{
    use SerializesModels;

    /**
     * @var ServiceRequest
     */
    public $serviceRequest;
    /**
     * @var Unit
     */
    public $unit;

    /**
     * Create a new message instance.
     *
     * @param ServiceRequest $serviceRequest
     */
    public function __construct(ServiceRequest $serviceRequest, Unit $unit)
    {
        $this->serviceRequest = $serviceRequest;
        $this->unit = $unit;
    }

    /**
     * Send Announcement created mail to property user
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->serviceRequest->user;
        $category = $this->serviceRequest->serviceRequestCategory;
        $property = $this->serviceRequest->property;

        return $this->subject('A service request made for your unit')->view('service-request.created.index')
            ->with(['serviceRequest' => $this->serviceRequest, 'user' => $user, 'unit' => $this->unit, 'category' => $category,  'property' => $property]);
    }
}
