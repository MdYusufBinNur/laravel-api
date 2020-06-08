<?php

namespace App\Mail\ServiceRequest;

use App\DbModels\ServiceRequest;
use App\DbModels\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceRequestAssignToStaff extends Mailable
{
    use SerializesModels;

    /**
     * @var ServiceRequest
     */
    public $serviceRequest;

    /**
     * @var User
     */
    public $assignByUser;
    /**
     * @var User
     */
    public $assignedUser;
    /**
     * @var User
     */
    public $serviceRequestCreatedUser;

    /**
     * Create a new message instance.
     *
     * @param ServiceRequest $serviceRequest
     * @param User $assignByUser
     * @param User $assignedUser
     * @param User $serviceRequestCreatedUser
     */
    public function __construct(ServiceRequest $serviceRequest, User $assignByUser, User $assignedUser, User $serviceRequestCreatedUser)
    {
        $this->serviceRequest = $serviceRequest;
        $this->assignByUser = $assignByUser;
        $this->assignedUser = $assignedUser;
        $this->serviceRequestCreatedUser = $serviceRequestCreatedUser;
    }

    /**
     * Send Announcement created mail to property user
     *
     * @return $this
     */
    public function build()
    {
        $unit = $this->serviceRequest->unit;
        $category = $this->serviceRequest->serviceRequestCategory;
        $property = $this->serviceRequest->property;
        $property = $this->serviceRequest->property;

        $serviceRequestItemPage = $property->getPropertyLink() . config('app.resident_portal_service_request_url_prefix') . '/' . $this->serviceRequest->id;

        return $this->subject('A service request Assigned To You')->view('service-request.assign-to-staff.index')
            ->with(['serviceRequestItemPage' => $serviceRequestItemPage, 'serviceRequest' => $this->serviceRequest, 'serviceRequestCreatedUser' => $this->serviceRequestCreatedUser, 'assignedUser' => $this->assignedUser, 'assignByUser' => $this->assignByUser, 'unit' => $unit, 'category' => $category,  'property' => $property]);
    }
}
