<?php


namespace App\Services\Reporting;

use App\Repositories\Contracts\ParkingPassLogRepository;
use App\Repositories\Contracts\ParkingPassRepository;
use App\Repositories\Contracts\ParkingSpaceRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ParkingManagement
{
    /**
     * get parking space items
     *
     * @param $searchCriteria
     * @return Model|Builder|object
     */
    public static function index($searchCriteria)
    {
        $parkingPassLogRepository = app(ParkingPassLogRepository::class);
        $parkingSpaceRepository = app(ParkingSpaceRepository::class);
        $parkingPassLogTable = $parkingPassLogRepository->getModel()->getTable();
        $parkingSpaceTable = $parkingSpaceRepository->getModel()->getTable();

        $query = isset($searchCriteria['spaceId']) ? $parkingSpaceTable . '.id' . '='. $searchCriteria['spaceId'] : '1 = 1';
        $endDate = isset($searchCriteria['endDate']) ? Carbon::parse($searchCriteria['endDate']) : Carbon::now();
        $startDate = isset($searchCriteria['startDate']) ? Carbon::parse($searchCriteria['startDate']) : Carbon::now();

        $data = DB::table($parkingSpaceTable)
            ->select($parkingSpaceTable . '.parkingNumber as spaceName')
            ->where($parkingSpaceTable . '.propertyId', $searchCriteria['propertyId'])
            ->whereRaw(DB::raw($query))
            ->join($parkingPassLogTable, $parkingSpaceTable . '.id', '=', $parkingPassLogTable . '.spaceId')
            ->selectRaw("count(case when " . $parkingPassLogTable.".event = 'created' then 1 end) as totalIn")
            ->selectRaw("count(case when " . $parkingPassLogTable.".event = 'updated' then 1 end) as totalOut")
            ->whereDate($parkingPassLogTable . '.created_at', '<=', $endDate)
            ->whereDate($parkingPassLogTable . '.created_at', '>=', $startDate)
            ->groupBy($parkingSpaceTable . '.parkingNumber')
            ->get();

        return $data;

    }

    /**
     * get parking management stats
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
     * parking management state count for a property
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
     * parking management state count for a property
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
     * parking management state count for a property
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
     * parking management state count for a property
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
