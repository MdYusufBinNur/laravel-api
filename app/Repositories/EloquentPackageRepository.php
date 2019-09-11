<?php


namespace App\Repositories;


use App\Repositories\Contracts\PackageRepository;

class EloquentPackageRepository extends EloquentBaseRepository implements PackageRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['type','resident','unit'];

        $packages =  parent::findBy($searchCriteria, $withTrashed);

        return $packages;
    }

}
