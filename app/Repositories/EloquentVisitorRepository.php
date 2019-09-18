<?php


namespace App\Repositories;

use App\DbModels\Visitor;
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

        return parent::save($data);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['property', 'visitorType'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
