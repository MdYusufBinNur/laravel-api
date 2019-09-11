<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\ServiceRequestMessage;
use App\Events\ServiceRequest\ServiceRequestCreatedEvent;
use App\Events\ServiceRequest\ServiceRequestUpdatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\ServiceRequestMessageRepository;
use App\Repositories\Contracts\ServiceRequestRepository;
use Illuminate\Support\Facades\DB;

class EloquentServiceRequestRepository extends EloquentBaseRepository implements ServiceRequestRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();
        $serviceRequest = parent::save($data);
        if (isset($data['attachmentId'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachment = $attachmentRepository->findOne($data['attachmentId']);
            if ($attachment instanceof Attachment) {
                $attachmentRepository->updateResourceId($attachment, $serviceRequest->id);
            }
            unset($data['attachmentId']);
        }

        DB::commit();

        // fire service request created event
        event(new ServiceRequestCreatedEvent($serviceRequest, $this->generateEventOptionsForModel()));

        return $serviceRequest;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        // save text in ServiceRequestMessage
        if (isset($data['feedbackText'])) {
            $serviceRequestMessageRepository = app(ServiceRequestMessageRepository::class);
            $serviceRequestMessageRepository->saveByServiceRequest($model, $data['feedbackText'], ServiceRequestMessage::TYPE_FEEDBACK);
            unset($data['feedbackText']);
        }

        $serviceRequest = parent::update($model, $data);

        event(new ServiceRequestUpdatedEvent($model, $this->generateEventOptionsForModel()));

        return $serviceRequest;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = isset($searchCriteria['include']) ? ['user', 'unit', 'unit.tower', 'logs', 'logs.user', 'user.userRoles'] : [];

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
