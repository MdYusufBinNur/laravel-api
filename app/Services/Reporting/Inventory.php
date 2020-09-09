<?php


namespace App\Services\Reporting;

use App\Repositories\Contracts\InventoryItemRepository;
use Illuminate\Support\Facades\DB;

class Inventory
{
    /**
     * get inventory items
     *
     * @param $searchCriteria
     * @return array
     */
    public static function index($searchCriteria)
    {
        $packageRepository = app(InventoryItemRepository::class);
        $data = $packageRepository->findBy($searchCriteria, true);

        return $data;

    }

    /**
     * get inventory stats
     *
     * @param $searchCriteria
     * @return array
     */
    public static function inventoryState($searchCriteria)
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
     * @return int
     */
    public static function getTotalInventoryItem($searchCriteria)
    {
        $inventoryRepository = app(InventoryItemRepository::class);
        $thisModelTable = $inventoryRepository->getModel()->getTable();

        $totalInventoryItem = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->count();

        return $totalInventoryItem;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getInventoryHealthyItem($searchCriteria)
    {
        $inventoryRepository = app(InventoryItemRepository::class);
        $thisModelTable = $inventoryRepository->getModel()->getTable();

        $totalInventoryItem = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('quantity', '>=', $searchCriteria['quantity'] )
            ->count();

        return $totalInventoryItem;
    }

    /**
     * inventory state count for a property
     *
     * @param $searchCriteria
     * @return int
     */
    public static function getInventoryRunningLowItem($searchCriteria)
    {
        $inventoryRepository = app(InventoryItemRepository::class);
        $thisModelTable = $inventoryRepository->getModel()->getTable();

        $totalInventoryItem = DB::table($thisModelTable)
            ->where('propertyId', $searchCriteria['propertyId'])
            ->where('quantity', '<=', $searchCriteria['quantity'] )
            ->count();

        return $totalInventoryItem;
    }

}
