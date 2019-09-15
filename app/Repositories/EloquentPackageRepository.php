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
        $searchCriteria['eagerLoad'] = ['type','resident','unit', 'enteredUser'];

        $packages =  parent::findBy($searchCriteria, $withTrashed);

        return $packages;
    }

    /**
     * @inheritdoc
     */
    public function save(array $data): \ArrayAccess
    {
        $data['enteredUserId'] = $this->getLoggedInUser()->id;
        $package = parent::save($data);

        return $package;
    }

}
