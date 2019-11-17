<?php


namespace App\Services\StatsHelper;


use App\DbModels\ResidentAccessRequest;
use App\DbModels\ServiceRequest;
use App\Repositories\Contracts\PackageRepository;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use App\Repositories\Contracts\ServiceRequestRepository;
use Carbon\Carbon;

class StaffReminderHelper
{

    /**
     * current staff reminder stats
     *
     * @param array $searchCriteria
     * @return array
     */
    public static function staffRemindersStats(array $searchCriteria = [])
    {
        /**
         * https://reformed.atlassian.net/jira/software/projects/PMW/boards/9/backlog?selectedIssue=PMW-181
         */
        return [
            'openServiceRequestCount' => self::allOpenServiceRequestCount(),
            'openServiceRequestWeekCount' => self::allOpenServiceRequestWeekCount(),

            'pendingResidentRequestsCount' => self::allPendingResidentAccessRequestCount(),
            'pendingResidentRequestsWeekCount' => self::allPendingResidentRequestsWeekCount(),

            'unArchivedPackagesCount' => self::allUnArchivedPackageCount(),
            'unArchivedPackagesWeekCount' => self::allUnArchivedPackagesWeekCount(),
            'pendingTaskCount' => 0, // todo
            'pendingTaskWeekCount' => 0, // todo
            'contentApprovalCount' => 0, // todo
            'contentApprovalWeekCount' => 0, // todo
        ];
    }

    /**
     * all open service requests
     *
     * @return int
     */
    public static function allOpenServiceRequestCount()
    {
        $serviceRequestRepository = app(ServiceRequestRepository::class);
        $openServiceRequests = $serviceRequestRepository->getModel()
            ->whereNotIn('status', [ServiceRequest::STATUS_CANCELLED, ServiceRequest::STATUS_RESOLVED])
            ->count();

        return $openServiceRequests;
    }

    /**
     * all open service requests in a week
     *
     * @return int
     */
    public static function allOpenServiceRequestWeekCount()
    {
        $serviceRequestRepository = app(ServiceRequestRepository::class);
        $openServiceRequests = $serviceRequestRepository->getModel()
            ->whereNotIn('status', [ServiceRequest::STATUS_CANCELLED, ServiceRequest::STATUS_RESOLVED])
            ->whereDate('created_at', '<=', Carbon::now()->subWeek())
            ->count();

        return $openServiceRequests;
    }

    /**
     * all pending resident access request
     *
     * @return int
     */
    public static function allPendingResidentAccessRequestCount()
    {
        $residentAccessRequestRepository = app(ResidentAccessRequestRepository::class);
        $residentAccessRequests = $residentAccessRequestRepository->getModel()
            ->where('status', ResidentAccessRequest::STATUS_PENDING)
            ->count();

        return $residentAccessRequests;
    }

    /**
     * all pending resident access request in a week
     *
     * @return int
     */
    public static function allPendingResidentRequestsWeekCount()
    {
        $residentAccessRequestRepository = app(ResidentAccessRequestRepository::class);
        $residentAccessRequests = $residentAccessRequestRepository->getModel()
            ->where('status', ResidentAccessRequest::STATUS_PENDING)
            ->whereDate('created_at', '<=', Carbon::now()->subWeek())
            ->count();

        return $residentAccessRequests;
    }

    /**
     * all unarchived packages count
     *
     * @return int
     */
    public static function allUnArchivedPackageCount()
    {
        $packageRepository = app(PackageRepository::class);
        $activePackages = $packageRepository->getModel()
            ->count();

        return $activePackages;
    }

    /**
     * all unarchived packages count in a week
     *
     * @return int
     */
    public static function allUnArchivedPackagesWeekCount()
    {
        $packageRepository = app(PackageRepository::class);
        $activePackages = $packageRepository->getModel()
            ->whereDate('created_at', '<=', Carbon::now()->subWeek())
            ->count();

        return $activePackages;
    }

}
