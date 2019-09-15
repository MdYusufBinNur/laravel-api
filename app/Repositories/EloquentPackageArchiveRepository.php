<?php


namespace App\Repositories;


use App\Repositories\Contracts\PackageArchiveRepository;
use Carbon\Carbon;

class EloquentPackageArchiveRepository extends EloquentBaseRepository implements PackageArchiveRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['property', 'package', 'package.property', 'package.type','package.resident','package.unit', 'package.enteredUser'];

        $packages =  parent::findBy($searchCriteria, $withTrashed);

        return $packages;
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $data['signOutAt'] = Carbon::now();
        $packageArchive = parent::save($data);

        return $packageArchive;
    }

}
