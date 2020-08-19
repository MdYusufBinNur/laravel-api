<?php


namespace App\Services\Reporting;


use App\Repositories\Contracts\StaffTimeClockRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StaffTimeClock
{
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
                DB::raw('DAY(clockedIn) as day'),
                DB::raw('DAYNAME(clockedIn) as dayName'),
                DB::raw('MONTHNAME(clockedIn) as month'),
                'clockedIn',
                'clockedOut'
            )
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('managerId', $searchCriteria['managerId'])
            ->whereYear('clockedIn', $searchCriteria['year'])
            ->whereMonth('clockedIn', $searchCriteria['month'])
            ->get();

        return $staffTimeClockReports;
    }
}
