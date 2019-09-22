<?php


namespace App\Repositories;


use App\DbModels\Visitor;
use App\Repositories\Contracts\VisitorArchiveRepository;
use App\Repositories\Contracts\VisitorRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentVisitorArchiveRepository extends EloquentBaseRepository implements VisitorArchiveRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['signOutUserId'] = $this->getLoggedInUser()->id;
        $data['signOutAt'] = Carbon::now();
        $visitorArchive = parent::save($data);

        $visitorRepository = app(VisitorRepository::class);
        $visitorRepository->delete($visitorArchive->visitor);

        DB::commit();


        return $visitorArchive;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $visitorModelTable = Visitor::getTableName();

        $queryBuilder = $this->model
            ->select($visitorModelTable . '.*', $thisModelTable . '.*')
            ->join($visitorModelTable, $visitorModelTable . '.id', '=', $thisModelTable . '.visitorId');

        if (isset($searchCriteria['unitId'])) {
            $queryBuilder = $queryBuilder->where($visitorModelTable . '.unitId', $searchCriteria['unitId']);
            unset($searchCriteria['unitId']);
        }

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('signOutAt', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('signOutAt', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        foreach ($searchCriteria as $key => $value) {
            if ($key != 'include') {
                $searchCriteria[$thisModelTable. '.' . $key] = $value;
                unset($searchCriteria[$key]);
            }

        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });
        $queryBuilder->with(['property', 'visitor']);


        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : $thisModelTable . '.id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);

        return $queryBuilder->paginate($limit);

    }

}
