<?php


namespace App\Services\Reporting;


use App\Repositories\Contracts\ServiceRequestRepository;

class ServiceRequest
{
    /**
     * current staff reminder stats
     *
     * @param array $searchCriteria
     * @return int
     */
    public static function serviceRequestsReports(array $searchCriteria = [])
    {
        return self::allServiceRequests($searchCriteria);
    }

    /**
     * all open service requests
     *
     * @param $searchCriteria
     * @return int
     */
    public static function allServiceRequests($searchCriteria)
    {
        $serviceRequestsRepository = app(ServiceRequestRepository::class);
        $serviceRequests = $serviceRequestsRepository->findBy($searchCriteria, true);

        return $serviceRequests;
    }
}
