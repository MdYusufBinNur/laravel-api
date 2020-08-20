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
        dd($data);
        return $data;

    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToday($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToday = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->whereDate( 'signInAt', Carbon::now())
            ->get();

        return $totalVisitorsToday;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToUnitToday($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUnitToday = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('unitId', $searchCriteria['unitId'])
            ->whereDate( 'signInAt', Carbon::now())
            ->get();

        return $totalVisitorsToUnitToday;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToUserToday($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUserToday = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('userId', $searchCriteria['userId'])
            ->whereDate( 'signInAt', Carbon::now())
            ->get();

        return $totalVisitorsToUserToday;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsOfAWeek($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsOfAWeek = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where(DB::raw("WEEKOFYEAR(signInAt)"), Carbon::now()->weekOfYear)
            ->get();

        return $totalVisitorsOfAWeek;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToUnitOfAWeek($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUnitOfAWeek = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('unitId', $searchCriteria['unitId'])
            ->where(DB::raw("WEEKOFYEAR(signInAt)"), Carbon::now()->weekOfYear)
            ->get();

        return $totalVisitorsToUnitOfAWeek;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToUserOfAWeek($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUserOfAWeek = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('userId', $searchCriteria['userId'])
            ->where(DB::raw("WEEKOFYEAR(signInAt)"), Carbon::now()->weekOfYear)
            ->get();

        return $totalVisitorsToUserOfAWeek;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsOfAYear($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsOfAYear = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->whereYear('signInAt', $searchCriteria['year'])
            ->get();

        return $totalVisitorsOfAYear;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToUnitOfAYear($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUnitOfAYear = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('unitId', $searchCriteria['unitId'])
            ->whereYear('signInAt', $searchCriteria['year'])
            ->get();

        return $totalVisitorsToUnitOfAYear;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToUserOfAYear($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUserOfAYear = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('userId', $searchCriteria['userId'])
            ->whereYear('signInAt', $searchCriteria['year'])
            ->get();

        return $totalVisitorsToUserOfAYear;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitors($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitors = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->get();

        return $totalVisitors;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToUnit($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUnit = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('userId', '=', NULL)
            ->get();

        return $totalVisitorsToUnit;
    }

    /**
     * visitors count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalVisitorsToUser($searchCriteria)
    {
        $visitorRepository = app(VisitorRepository::class);
        $thisModelTable = $visitorRepository->getModel()->getTable();

        $totalVisitorsToUser = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalVisitors'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('unitId', '=', NULL)
            ->get();

        return $totalVisitorsToUser;
    }

}
