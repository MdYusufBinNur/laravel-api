<?php


namespace App\Repositories;

use App\DbModels\Package;
use App\Events\PackageArchive\PackageArchivedCreatedEvent;
use App\Repositories\Contracts\PackageArchiveRepository;
use App\Repositories\Contracts\PackageRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentPackageArchiveRepository extends EloquentBaseRepository implements PackageArchiveRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $packageModelTable = Package::getTableName();

        //todo search by keyword

        $queryBuilder = $this->model
            ->select($packageModelTable . '.*', $thisModelTable . '.*')
            ->join($packageModelTable, 'packages' . '.id', '=', 'package_archives' . '.packageId');

        if (isset($searchCriteria['unitId'])) {
            $queryBuilder = $queryBuilder->where($packageModelTable. '.unitId', $searchCriteria['unitId']);
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

        $queryBuilder->with(['property', 'package', 'signOutUser', 'package.property', 'package.type','package.resident','package.unit', 'package.enteredUser']);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : $thisModelTable . '.id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);

        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();
        $data['signOutAt'] = Carbon::now();
        $packageArchive = parent::save($data);

        $packageRepository = app(PackageRepository::class);
        $packageRepository->delete($packageArchive->package);

        DB::commit();

        event(new PackageArchivedCreatedEvent($packageArchive, $this->generateEventOptionsForModel()));


        return $packageArchive;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $packageArchive = parent::update($model, $data);

        return $packageArchive;
    }

}
