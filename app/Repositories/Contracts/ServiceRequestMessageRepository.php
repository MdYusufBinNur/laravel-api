<?php


namespace App\Repositories\Contracts;


use App\DbModels\ServiceRequest;

interface ServiceRequestMessageRepository extends BaseRepository
{
    /**
     * save by service request
     *
     * @param ServiceRequest $serviceRequest
     * @param string $text
     * @param string $type
     * @return mixed
     */
    public function saveByServiceRequest(ServiceRequest $serviceRequest, $text, $type);

}
