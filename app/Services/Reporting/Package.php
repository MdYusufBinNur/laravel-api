<?php


namespace App\Services\Reporting;


use App\Repositories\Contracts\PackageRepository;

class Package
{
    /**
     * current staff reminder stats
     *
     * @param array $searchCriteria
     * @return int
     */
    public static function packageReports(array $searchCriteria = [])
    {
        return self::allPackages($searchCriteria);
    }

    /**
     * all open service requests
     *
     * @param $searchCriteria
     * @return int
     */
    public static function allPackages($searchCriteria)
    {
        $packageRepository = app(PackageRepository::class);
        $packages = $packageRepository->findBy($searchCriteria, true);

        return $packages;
    }

}
