<?php


namespace App\Repositories;


use App\Repositories\Contracts\ServiceRequestOfficeDetailRepository;

class EloquentServiceRequestOfficeDetailRepository extends EloquentBaseRepository implements ServiceRequestOfficeDetailRepository
{
    /**
     * @inheritDoc
     */
    public function setServiceRequestOfficeDetail(array $data) : \ArrayAccess
    {
        return $this->patch(['serviceRequestId' => $data['serviceRequestId']], $data);
    }
}
