<?php


namespace App\Repositories\Contracts;


interface ServiceRequestOfficeDetailRepository extends BaseRepository
{
    /**
     * set service request office detail
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setServiceRequestOfficeDetail(array $data) : \ArrayAccess;

}
