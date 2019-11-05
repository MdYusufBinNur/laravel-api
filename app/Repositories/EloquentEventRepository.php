<?php


namespace App\Repositories;


use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\EventRepository;
use Carbon\Carbon;

class EloquentEventRepository extends EloquentBaseRepository implements EventRepository
{
    /**
     * @inheritdoc
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
        $searchCriteria['eagerLoad'] = ['event.createdByUser' => 'createdByUser', 'event.property' => 'property', 'event.attachments' => 'attachments', 'event.signups' => 'eventSignups'];

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $event = parent::save($data);

        if (isset($data['attachmentIds'])) {

            $attachmentRepository = app(AttachmentRepository::class);
            $attachmentRepository->updateResourceIds($data['attachmentIds'], $event->id);
            $data['hasAttachment'] = true;
            unset($data['attachmentId']);

            $event = $this->update($event, $data);
        }


        return $event;
    }

    /**
     * @inheritDoc
     */
    public function getEventsForLds(array $searchCriteria)
    {
        $queryBuilder = $this->model
            ->whereDate('date', '>=', Carbon::now())
            ->where('propertyId', $searchCriteria['propertyId']);

        return $queryBuilder->get();
    }

}
