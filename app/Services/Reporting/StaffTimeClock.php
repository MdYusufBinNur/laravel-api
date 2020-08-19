<?php


namespace App\Services\Reporting;


use App\DbModels\Manager;
use App\DbModels\User;
use App\Repositories\Contracts\StaffTimeClockRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StaffTimeClock
{
    /**
     * get STC stats
     *
     * @param $searchCriteria
     * @return array
     */
    public static function staffTimeClockStats($searchCriteria)
    {
        return [
            'daysWorkedInAYearCount' => self::getDaysWorkedInAYearCount($searchCriteria),
            'hoursWorkedInAMonth' => self::getHoursWorkedInAMonth($searchCriteria),
            'topPerformerOfADay' => self::getTopPerformerOfADay($searchCriteria)
        ];

    }

    /**
     * all pending resident access request
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getDaysWorkedInAYearCount($searchCriteria)
    {
        $staffTimeClockRepository = app(StaffTimeClockRepository::class);
        $thisModelTable = $staffTimeClockRepository->getModel()->getTable();

        $daysWorkedInAYearCount = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(DISTINCT clockedIn) as days'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->whereYear('clockedIn', $searchCriteria['year'])
            ->get();

        return $daysWorkedInAYearCount;
    }

    /**
     * all pending resident access request
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getHoursWorkedInAMonth($searchCriteria)
    {
        $staffTimeClockRepository = app(StaffTimeClockRepository::class);
        $thisModelTable = $staffTimeClockRepository->getModel()->getTable();

        $hoursWorkedInAMonth = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(DISTINCT clockedIn) as days'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->whereYear('clockedIn', $searchCriteria['year'])
            ->whereMonth('clockedIn', $searchCriteria['month'])
            ->get();

        return $hoursWorkedInAMonth;
    }

    /**
     * all pending resident access request
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTopPerformerOfADay($searchCriteria)
    {
        $staffTimeClockRepository = app(StaffTimeClockRepository::class);
        $thisModelTable = $staffTimeClockRepository->getModel()->getTable();
        $managerTable = Manager::getTableName();
        $userTable = User::getTableName();

        $topPerformerOfADay = DB::table($thisModelTable)
            ->select($thisModelTable . '.clockedIn', $thisModelTable . '.state', $thisModelTable . '.managerId', $userTable . '.name' )
            ->join($managerTable, $thisModelTable . '.managerId', '=', $managerTable . '.id')
            ->join($userTable, $managerTable . '.userId', '=', $userTable . '.id')
            ->where($thisModelTable . '.propertyId', $searchCriteria['propertyId'])
            ->whereDate($thisModelTable . '.clockedIn', Carbon::now())
            ->orderBy($thisModelTable . '.clockedIn', 'ASC')
            ->limit(1)
            ->get();

        return $topPerformerOfADay;
    }

    /**
     * all open service requests
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function fetchMonthWiseStaffAttendance($searchCriteria)
    {
        $staffTimeClockRepository = app(StaffTimeClockRepository::class);
        $thisModelTable = $staffTimeClockRepository->getModel()->getTable();

        $staffTimeClockReports = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as days'), DB::raw('MONTHNAME(clockedIn) as month'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('managerId', $searchCriteria['managerId'])
            ->whereYear('clockedIn', $searchCriteria['year'])
            ->groupBy('month')
            ->get();

        return $staffTimeClockReports;
    }

    /**
     * all open service requests
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function fetchWorkingHoursWiseStaffAttendance($searchCriteria)
    {
        $staffTimeClockRepository = app(StaffTimeClockRepository::class);
        $thisModelTable = $staffTimeClockRepository->getModel()->getTable();

        $staffTimeClockReports = DB::table($thisModelTable)
            ->select(
                'clockedIn',
                'clockedOut'
            )
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('managerId', $searchCriteria['managerId'])
            ->whereYear('clockedIn', $searchCriteria['year'])
            ->whereMonth('clockedIn', $searchCriteria['month'])
            ->orderBy('clockedIn')
            ->get();

        return $staffTimeClockReports;
    }
}
