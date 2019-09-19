<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\Fdi;
use App\Events\Fdi\FdiCreatedEvent;
use App\Events\Fdi\FdiUpdatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\FdiRepository;
use Carbon\Carbon;

class EloquentFdiRepository extends EloquentBaseRepository implements FdiRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $fdi = parent::save($data);

        if (isset($data['attachmentId'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachment = $attachmentRepository->findOne($data['attachmentId']);
            if ($attachment instanceof Attachment) {
                $attachmentRepository->updateResourceId($attachment, $fdi->id);
            }
            unset($data['attachmentId']);
        }
        // fire service request created event
        event(new FdiCreatedEvent($fdi, $this->generateEventOptionsForModel()));

        return $fdi;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $fdi = parent::update($model, $data);

        event(new FdiUpdatedEvent($model, $this->generateEventOptionsForModel()));

        return $fdi;
    }

    /**
     * @inheritDoc
     */
    public function deleteFdi(Fdi $fdi)
    {
        $data['status'] = Fdi::STATUS_DELETED;

        return $this->update($fdi, $data);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {

        $searchCriteria['status'] = $this->getSearchCriteriaByStatus($searchCriteria);

        $queryBuilder = $this->model;

        if ($searchCriteria['status'] === 'future') {
            $queryBuilder = $queryBuilder->whereDate('startDate', '>', Carbon::now());
            unset($searchCriteria['status']);
        }

        if (isset($searchCriteria['status']) && $searchCriteria['status'] === 'all') {
            unset($searchCriteria['status']);
        }

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('endDate', '<=', Carbon::parse($searchCriteria['endDate']))
                ->orWhere('permanent', 1);
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('startDate', '>=', Carbon::parse($searchCriteria['startDate']))
                ->orWhere('permanent', 1);
            unset($searchCriteria['startDate']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });
        $queryBuilder->with(['unit', 'property', 'logs', 'logs.createdByUser', 'logs.user']);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15; // it's needed for pagination
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * get search criteria by status
     *
     * @param array $searchCriteria
     * @return string
     */
    private function getSearchCriteriaByStatus(array $searchCriteria)
    {

        $status = Fdi::STATUS_ACTIVE;
        if (isset($searchCriteria['status'])) {
            switch ($searchCriteria['status']) {
                case Fdi::STATUS_DELETED:
                    $status = Fdi::STATUS_DELETED;
                    break;
                case Fdi::STATUS_PENDING_APPROVAL:
                    $status = Fdi::STATUS_PENDING_APPROVAL;
                    break;
                case Fdi::STATUS_EXPIRED:
                    $status = Fdi::STATUS_EXPIRED;
                    break;
                case Fdi::STATUS_DENIED:
                    $status = Fdi::STATUS_DENIED;
                    break;
                case 'future':
                    $status = 'future';
                    break;
                case 'all':
                    $status = 'all';
                    break;
            }
        }

        return $status;
    }

}
