<?php

namespace App\Mail\ServiceRequest;

use App\DbModels\ServiceRequest;
use App\DbModels\Unit;
use App\DbModels\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceRequestStatusUpdated extends Mailable
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
     * @var User
     */
    public $statusUpdatedByUser;

    /**
     * Create a new message instance.
     *
     * @param ServiceRequest $serviceRequest
     * @param User $statusUpdatedByUser
     * @param Unit $unit
     */
    public function __construct(ServiceRequest $serviceRequest, User $statusUpdatedByUser, Unit $unit)
    {
        $this->serviceRequest = $serviceRequest;
        $this->statusUpdatedByUser = $statusUpdatedByUser;
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
        $property = $this->serviceRequest->property;

        $status = ucwords(str_replace('_', ' ', $this->serviceRequest->status));

        return $this->subject('Your Service Request Is ' . $status)->view('service-request.status-updated.index')
            ->with(['serviceRequest' => $this->serviceRequest, 'user' => $user, 'statusUpdatedByUser' => $this->statusUpdatedByUser, 'property' => $property]);
    }
}
