<?php


namespace App\Repositories;

use App\DbModels\Attachment;
use App\DbModels\Visitor;
use App\Events\Visitor\VisitorCreatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\VisitorRepository;
use Carbon\Carbon;

class EloquentVisitorRepository extends EloquentBaseRepository implements VisitorRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $data['status'] = $data['status'] ?? Visitor::STATUS_ACTIVE;
        $data['signInUserId'] = $this->getLoggedInUser()->id;
        $data['signInAt'] = Carbon::now();
        $visitor = parent::save($data);

        if (isset($data['attachmentId'])) {
            $attachmentRepository = app(AttachmentRepository::class);
            $attachment = $attachmentRepository->findOne($data['attachmentId']);

            if (!empty($data['copyOldAttachment'])) {
                $attachmentRepository->copyOldAttachment($attachment, ['resourceId' => $visitor->id]);
                unset($data['copyOldAttachment']);

            } else {
                if ($attachment instanceof Attachment) {
                    $attachmentRepository->updateResourceId($attachment, $visitor->id);
                }
            }
            unset($data['attachmentId']);
        }


        event(new VisitorCreatedEvent($visitor, $this->generateEventOptionsForModel()));

        return $visitor;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterByUserType($searchCriteria);
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        if (isset($searchCriteria['query'])) {
            $queryBuilder = $queryBuilder->where('name', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('phone', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('email', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('company', 'like', '%' . $searchCriteria['query'] . '%');
            unset($searchCriteria['query']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });
        $searchCriteria['eagerLoad'] = ['visitor.createdByUser' => 'createdByUser', 'visitor.property' => 'property',  'visitor.visitorType' => 'visitorType', 'visitor.unit' => 'unit', 'visitor.image' => 'image'];
        $queryBuilder = $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        if (empty($searchCriteria['withOutPagination'])) {
            return $queryBuilder->paginate($limit);
        } else {
            return $queryBuilder->get();
        }

    }

    /**
     * add more criteria by user type
     * @param array $searchCriteria
     * @return array
     */
    private function applyFilterByUserType(array $searchCriteria)
    {
        $loggedInUser = $this->getLoggedInUser();
        $propertyId = $searchCriteria['propertyId'];

        //if a resident only
        if (!$loggedInUser->isAdmin() &&
            !$loggedInUser->isAnEnterpriseUserOfTheProperty($propertyId) &&
            !$loggedInUser->isAStaffOfTheProperty($propertyId) &&
            $this->getLoggedInUser()->isResident($propertyId)) {

            $unitIds = $this->getLoggedInUser()->getResidentsUnitIdsOfTheProperty($propertyId);
            $searchCriteria['unitId'] = implode(',', $unitIds);
            
        }

        return $searchCriteria;
    }

}
