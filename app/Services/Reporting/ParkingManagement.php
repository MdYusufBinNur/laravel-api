<?php


namespace App\Services\Reporting;

use App\Repositories\Contracts\InventoryItemRepository;
use App\Repositories\Contracts\ParkingPassLogRepository;
use App\Repositories\Contracts\ParkingPassRepository;
use App\Repositories\Contracts\ParkingSpaceRepository;
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
        $parkingPassRepository = app(ParkingPassRepository::class);
        $parkingPassLogRepository = app(ParkingPassLogRepository::class);
        $parkingPassLogRepository = app(ParkingSpaceRepository::class);
//        $data = $packageRepository->findBy($searchCriteria, true);

        return true;

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
            'totalInventoryItem' => self::getTotalInventoryItem($searchCriteria),
            'inventoryHealthyItem' => self::getInventoryHealthyItem($searchCriteria),
            'inventoryRunningLowItem' => self::getInventoryRunningLowItem($searchCriteria),
        ];
        return $data;

    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getTotalInventoryItem($searchCriteria)
    {
        $inventoryRepository = app(InventoryItemRepository::class);
        $thisModelTable = $inventoryRepository->getModel()->getTable();

        $totalInventoryItem = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalInventoryItem'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->get();

        return $totalInventoryItem[0]->totalInventoryItem;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getInventoryHealthyItem($searchCriteria)
    {
        $inventoryRepository = app(InventoryItemRepository::class);
        $thisModelTable = $inventoryRepository->getModel()->getTable();

        $totalInventoryItem = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalInventoryItem'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('quantity', '<=', $searchCriteria['quantity'] )
            ->get();

        return $totalInventoryItem[0]->totalInventoryItem;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return Collection
     */
    public static function getInventoryRunningLowItem($searchCriteria)
    {
        $inventoryRepository = app(InventoryItemRepository::class);
        $thisModelTable = $inventoryRepository->getModel()->getTable();

        $totalInventoryItem = DB::table($thisModelTable)
            ->select(DB::raw('COUNT(id) as totalInventoryItem'))
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('quantity', '>=', $searchCriteria['quantity'] )
            ->get();

        return $totalInventoryItem[0]->totalInventoryItem;
    }

}
