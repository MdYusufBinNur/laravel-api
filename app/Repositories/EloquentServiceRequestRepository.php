<?php


namespace App\Repositories;


use App\Events\ServiceRequest\ServiceRequestUpdatedEvent;
use App\Repositories\Contracts\ServiceRequestRepository;

class EloquentServiceRequestRepository extends EloquentBaseRepository implements ServiceRequestRepository
{
    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $serviceRequest = parent::update($model, $data);

        event(new ServiceRequestUpdatedEvent($model, $this->generateEventOptionsForModel()));
        //event(new ServiceRequestUpdatedEvent($model, array_merge(['oldServiceRequest' => $this->oldModel], $data)));

        return $serviceRequest;
    }

}
