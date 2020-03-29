<?php


namespace App\Repositories;


use App\Events\Announcement\AnnouncementCreatedEvent;
use App\Repositories\Contracts\AnnouncementRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentAnnouncementRepository extends EloquentBaseRepository implements AnnouncementRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $announcement = parent::save($data);

        DB::commit();

        event(new AnnouncementCreatedEvent($announcement, $this->generateEventOptionsForModel()));

        return $announcement;
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;
        if (isset($searchCriteria['query'])) {
            $queryBuilder = $queryBuilder->where('title', 'like', '%'.$searchCriteria['query'].'%');
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['expireAt'])) {
            $queryBuilder = $queryBuilder->whereDate('expireAt', '=', $searchCriteria['expireAt']);
            unset($searchCriteria['expireAt']);
        }

        if(isset($searchCriteria['isExpired'])){
            if ($searchCriteria['isExpired']) {
                $queryBuilder = $queryBuilder->whereDate('expireAt', '<=', Carbon::now());
            } else{
                $queryBuilder = $queryBuilder->whereDate('expireAt', '>=', Carbon::now());
            }
            unset($searchCriteria['isExpired']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

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
     * @inheritDoc
     */
    public function getAnnouncementsForLds(array $searchCriteria)
    {
        $queryBuilder = $this->model
            ->where('showOnLds', 1)
            ->whereDate('expireAt', '>=', Carbon::now())
            ->where('propertyId', $searchCriteria['propertyId']);

        return $queryBuilder->get();
    }

}
