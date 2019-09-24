<?php


namespace App\Repositories\Contracts;


interface PackageRepository extends BaseRepository
{
    /**
     * get all packages to show in lds
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function getPackagesForLds(array $searchCriteria);
}
