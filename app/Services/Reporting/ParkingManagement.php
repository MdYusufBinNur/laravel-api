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
     * @return array
     */
    public static function index($searchCriteria)
    {
        $parkingPassLogRepository = app(ParkingPassLogRepository::class);
        $parkingSpaceRepository = app(ParkingSpaceRepository::class);
        $parkingPassLogTable = $parkingPassLogRepository->getModel()->getTable();
        $parkingSpaceTable = $parkingSpaceRepository->getModel()->getTable();

        $data = DB::table($parkingSpaceTable)
            ->select($parkingSpaceTable . '.parkingNumber as spaceName', DB::raw('COUNT(id) as totalSpace'), DB::raw('COUNT(id) as totalSpace') )
            ->join($parkingPassLogTable, $parkingSpaceTable . '.id', '=', $parkingPassLogTable . '.spaceId')
            ->where($parkingSpaceTable . '.propertyId', $searchCriteria['propertyId'])
            ->whereDate($parkingPassTable . '.startAt', Carbon::now())
            ->whereDate($parkingPassTable . '.releaseAt', '!=', null)
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
     * @return Collection
     */
    public static function getTotalSpace($searchCriteria)
    {
        $parkingSpaceRepository = app(ParkingSpaceRepository::class);
        $thisModelTable = $parkingSpaceRepository->getModel()->getTable();

        $totalSpace = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalSpace'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->get();

        return $totalSpace[0]->totalSpace;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getInUseSpace($searchCriteria)
    {
        $parkingPassRepository = app(ParkingPassRepository::class);
        $parkingPassTable = $parkingPassRepository->getModel()->getTable();

        $totalInUseSpace = DB::table($parkingPassTable)
            ->select(DB::raw('COUNT(id) as totalInUseSpace'))
            ->where($parkingPassTable . '.propertyId', $searchCriteria['propertyId'])
            ->whereNull($parkingPassTable . '.releasedAt')
            ->get();

        return $totalInUseSpace[0]->totalInUseSpace;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTodayTotalIn($searchCriteria)
    {
        $parkingPassLogRepository = app(ParkingPassLogRepository::class);
        $parkingPassLogTable = $parkingPassLogRepository->getModel()->getTable();

        $totalIn = DB::table($parkingPassLogTable)
            ->select(DB::raw('COUNT(id) as totalIn'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where($parkingPassLogTable . '.event', 'created')
            ->whereDate($parkingPassLogTable . '.startAt', Carbon::now())
            ->get();

        return $totalIn[0]->totalIn;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTodayTotalOut($searchCriteria)
    {
        $parkingPassLogRepository = app(ParkingPassLogRepository::class);
        $parkingPassLogTable = $parkingPassLogRepository->getModel()->getTable();

        $totalIn = DB::table($parkingPassLogTable)
            ->select(DB::raw('COUNT(id) as totalOut'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where($parkingPassLogTable . '.event', '=', 'updated')
            ->whereDate($parkingPassLogTable . '.releasedAt', Carbon::now())
            ->get();

        return $totalIn[0]->totalOut;
    }

}
