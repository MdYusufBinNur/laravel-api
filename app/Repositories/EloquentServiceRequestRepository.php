<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\ServiceRequest;
use App\DbModels\ServiceRequestMessage;
use App\Events\ServiceRequest\ServiceRequestCreatedEvent;
use App\Events\ServiceRequest\ServiceRequestUpdatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\ServiceRequestMessageRepository;
use App\Repositories\Contracts\ServiceRequestRepository;
use Carbon\Carbon;
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

        if (isset($data['attachmentIds'])) {
            $attachmentRepository = app(AttachmentRepository::class);

            foreach ($data['attachmentIds'] as $attachment) {
                $attachment = $attachmentRepository->findOne($attachment);
                if ($attachment instanceof Attachment) {
                    $attachmentRepository->updateResourceId($attachment, $serviceRequest->id);
                }
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

        if (isset($data['status']) ) {
            if ($data['status'] == ServiceRequest::STATUS_RESOLVED) {
                $data['resolvedAt'] = Carbon::now();
            }
        }

        $serviceRequest = parent::update($model, $data);

        event(new ServiceRequestUpdatedEvent($serviceRequest, $this->generateEventOptionsForModel()));

        return $serviceRequest;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('date', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('date', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        $searchCriteria['eagerLoad'] = ['sr.user' => 'user', 'sr.category' => 'serviceRequestCategory', 'sr.unit' => 'unit', 'unit.tower' => 'unit.tower', 'sr.logs' => 'logs', 'srLog.user' => 'logs.user', 'user.roles' => 'user.userRoles', 'sr.photos' => 'serviceRequestPhotos'];

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
