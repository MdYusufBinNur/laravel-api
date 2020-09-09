<?php


namespace App\Services\Reporting;

use App\Repositories\Contracts\InventoryItemRepository;
use App\Repositories\Contracts\ParkingPassLogRepository;
use App\Repositories\Contracts\ParkingPassRepository;
use App\Repositories\Contracts\ParkingSpaceRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ParkingManagement
{
    /**
     * get inventory items
     *
     * @param $searchCriteria
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public static function index($searchCriteria)
    {
        $parkingPassLogRepository = app(ParkingPassLogRepository::class);
        $parkingSpaceRepository = app(ParkingSpaceRepository::class);
        $parkingPassLogTable = $parkingPassLogRepository->getModel()->getTable();
        $parkingSpaceTable = $parkingSpaceRepository->getModel()->getTable();

        $data = DB::table($parkingSpaceTable)
            ->select($parkingSpaceTable . '.parkingNumber as spaceName')
            ->join($parkingPassLogTable, $parkingSpaceTable . '.id', '=', $parkingPassLogTable . '.spaceId')
            ->selectRaw("count(case when " . $parkingPassLogTable.".event = 'created' then 1 end) as totalIn")
            ->selectRaw("count(case when " . $parkingPassLogTable.".event = 'updated' then 1 end) as totalOut")
            ->where($parkingSpaceTable . '.propertyId', $searchCriteria['propertyId'])
            ->whereDate($parkingPassLogTable . '.created_at', '<=', Carbon::parse($searchCriteria['endDate']))
            ->whereDate($parkingPassLogTable . '.created_at', '>=', Carbon::parse($searchCriteria['startDate']))
            ->groupBy($parkingSpaceTable . '.parkingNumber')
            ->get();

        return $data;

    }

    /**
     * get inventory stats
     *
     * @param $searchCriteria
     * @return array
     */
    public static function parkingState($searchCriteria)
    {

        $data = [
            'totalSpace' => self::getTotalSpace($searchCriteria),
            'inUseSpace' => self::getInUseSpace($searchCriteria),
            'todayTotalIn' => self::getTodayTotalIn($searchCriteria),
            'todayTotalOut' => self::getTodayTotalOut($searchCriteria),
        ];
        return $data;

    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTotalSpace($searchCriteria)
    {
        $parkingSpaceRepository = app(ParkingSpaceRepository::class);
        $thisModelTable = $parkingSpaceRepository->getModel()->getTable();

        $totalSpace = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->count();
        return $totalSpace;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getInUseSpace($searchCriteria)
    {
        $parkingPassRepository = app(ParkingPassRepository::class);
        $parkingPassTable = $parkingPassRepository->getModel()->getTable();

        $totalInUseSpace = DB::table($parkingPassTable)
            ->where($parkingPassTable . '.propertyId', $searchCriteria['propertyId'])
            ->whereNull($parkingPassTable . '.releasedAt')
            ->count();

        return $totalInUseSpace;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTodayTotalIn($searchCriteria)
    {
        $parkingPassLogRepository = app(ParkingPassLogRepository::class);
        $parkingPassLogTable = $parkingPassLogRepository->getModel()->getTable();

        $totalIn = DB::table($parkingPassLogTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where($parkingPassLogTable . '.event', 'created')
            ->whereDate($parkingPassLogTable . '.startAt', Carbon::now())
            ->count();

        return $totalIn;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getTodayTotalOut($searchCriteria)
    {
        $parkingPassLogRepository = app(ParkingPassLogRepository::class);
        $parkingPassLogTable = $parkingPassLogRepository->getModel()->getTable();

        $totalIn = DB::table($parkingPassLogTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where($parkingPassLogTable . '.event', '=', 'updated')
            ->whereDate($parkingPassLogTable . '.releasedAt', Carbon::now())
            ->count();

        return $totalIn;
    }

}
