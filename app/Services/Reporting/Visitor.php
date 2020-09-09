<?php


namespace App\Services\Reporting;

use App\Repositories\Contracts\VisitorRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Visitor
{
    /**
     * get STC stats
     *
     * @param $searchCriteria
     * @return array
     */
    public static function visitorState($searchCriteria)
    {
        $data = [
            'totalVisitorsToday' => self::getTotalVisitorsToday($searchCriteria),
            'totalVisitorsToUnitToday' => self::getTotalVisitorsToUnitToday($searchCriteria),
            'totalVisitorsToUserToday' => self::getTotalVisitorsToUserToday($searchCriteria),
            'totalVisitorsOfAWeek' => self::getTotalVisitorsOfAWeek($searchCriteria),
            'totalVisitorsToUnitOfAWeek' => self::getTotalVisitorsToUnitOfAWeek($searchCriteria),
            'totalVisitorsToUserOfAWeek' => self::getTotalVisitorsToUserOfAWeek($searchCriteria),
            'totalVisitorsOfAYear' => self::getTotalVisitorsOfAYear($searchCriteria),
            'totalVisitorsToUnitOfAYear' => self::getTotalVisitorsToUnitOfAYear($searchCriteria),
            'totalVisitorsToUserOfAYear' => self::getTotalVisitorsToUserOfAYear($searchCriteria),
            'totalVisitors' => self::getTotalVisitors($searchCriteria),
            'totalVisitorsToUnit' => self::getTotalVisitorsToUnit($searchCriteria),
            'totalVisitorsToUser' => self::getTotalVisitorsToUser($searchCriteria),
        ];
        return $data;

    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToday($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToday = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->whereDate( 'signInAt', Carbon::now())
            ->count();

        return $totalVisitorsToday;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToUnitToday($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUnitToday = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('unitId', '!=', NULL)
            ->whereDate( 'signInAt', Carbon::now())
            ->count();

        return $totalVisitorsToUnitToday;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToUserToday($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUserToday = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('userId', '!=', NULL)
            ->whereDate( 'signInAt', Carbon::now())
            ->count();

        return $totalVisitorsToUserToday;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsOfAWeek($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsOfAWeek = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where(DB::raw("WEEKOFYEAR(signInAt)"), Carbon::now()->weekOfYear)
            ->count();

        return $totalVisitorsOfAWeek;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToUnitOfAWeek($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUnitOfAWeek = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('unitId', '!=', NULL)
            ->where(DB::raw("WEEKOFYEAR(signInAt)"), Carbon::now()->weekOfYear)
            ->count();

        return $totalVisitorsToUnitOfAWeek;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToUserOfAWeek($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUserOfAWeek = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('userId', '!=', NULL)
            ->where(DB::raw("WEEKOFYEAR(signInAt)"), Carbon::now()->weekOfYear)
            ->count();

        return $totalVisitorsToUserOfAWeek;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsOfAYear($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsOfAYear = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->whereYear('signInAt', Carbon::now()->year)
            ->count();

        return $totalVisitorsOfAYear;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToUnitOfAYear($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUnitOfAYear = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('unitId', '!=', NULL)
            ->whereYear('signInAt', Carbon::now()->year)
            ->count();

        return $totalVisitorsToUnitOfAYear;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToUserOfAYear($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUserOfAYear = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('userId', '!=', NULL)
            ->whereYear('signInAt', Carbon::now()->year)
            ->count();

        return $totalVisitorsToUserOfAYear;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitors($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitors = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->count();

        return $totalVisitors;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToUnit($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUnit = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('unitId', '!=', NULL)
            ->count();

        return $totalVisitorsToUnit;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalVisitorsToUser($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUser = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('userId', '!=', NULL)
            ->count();

        return $totalVisitorsToUser;
    }

    /**
     * month wise visitors count
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function fetchMonthWiseVisitors($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        if (isset($searchCriteria['unitId'])){
            $userIdOrUnit = 'unitId';
            $userIdOrUnitId = $searchCriteria['unitId'];
        } else {
            $userIdOrUnit = 'userId';
            $userIdOrUnitId = $searchCriteria['userId'];
        }

        $visitors = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as visitors'), DB::raw('MONTHNAME(signInAt) as month'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where($userIdOrUnit, $userIdOrUnitId)
            ->whereYear('signInAt', $searchCriteria['year'])
            ->groupBy('month')
            ->get();

        return $visitors;
    }


    /**
     * day wise visitors count
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function fetchDayWiseVisitors($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        if (isset($searchCriteria['unitId'])){
            $userIdOrUnit = 'unitId';
            $userIdOrUnitId = $searchCriteria['unitId'];
        } else {
            $userIdOrUnit = 'userId';
            $userIdOrUnitId = $searchCriteria['userId'];
        }

        $visitors = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as visitors'),  'signInAt')
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where($userIdOrUnit, $userIdOrUnitId)
            ->whereYear('signInAt', $searchCriteria['year'])
            ->whereMonth('signInAt', $searchCriteria['month'])
            ->groupBy('signInAt')
            ->get();

        return $visitors;

    }
}
