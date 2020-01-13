<?php


namespace App\Repositories;


use App\DbModels\ServiceRequest;
use App\Events\ServiceRequestMessage\ServiceRequestMessageCreatedEvent;
use App\Repositories\Contracts\ServiceRequestMessageRepository;

class EloquentServiceRequestMessageRepository extends EloquentBaseRepository implements ServiceRequestMessageRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        if (empty($searchCriteria['unitId'])) {
            $loggedInUser = $this->getLoggedInUser();
            if ($loggedInUser->isOnlyResidentOfTheProperty($searchCriteria['propertyId'])) {
                $searchCriteria['unitId'] = $loggedInUser->getResidentsUnitIdsOfTheProperty($searchCriteria['propertyId']);
            }
        }
        
        $searchCriteria['eagerLoad'] = ['srm.user' => 'user'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $serviceRequestMessage = parent::save($data);

        // fire service request message created event
        event(new ServiceRequestMessageCreatedEvent($serviceRequestMessage, $this->generateEventOptionsForModel()));

        return $serviceRequestMessage;
    }

    /**
     * @inheritDoc
     */
    public function saveByServiceRequest(ServiceRequest $serviceRequest, $text, $type)
    {
        $data['text'] = $text;
        $data['type'] = $type;
        $data['userId'] = $serviceRequest->userId;
        $data['serviceRequestId'] = $serviceRequest->id;
        $data['propertyId'] = $serviceRequest->propertyId;
        $data['unitId'] = $serviceRequest->unitId;

        return $this->save($data);

    }

}
