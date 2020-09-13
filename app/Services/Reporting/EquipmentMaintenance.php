<?php


namespace App\Services\Reporting;

use App\Repositories\Contracts\AnnouncementRepository;
use App\Repositories\Contracts\EquipmentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class EquipmentMaintenance
{
    /**
     * get inventory items
     *
     * @param $searchCriteria
     * @return array
     */
    public static function index($searchCriteria)
    {
        $equipmentRepository = app(EquipmentRepository::class);
        $data = $equipmentRepository->findBy($searchCriteria, true);

        return $data;
    }

    /**
     * get resident access request states
     *
     * @param $searchCriteria
     * @return Model|Builder|object
     */
    public static function equipmentMaintenanceState($searchCriteria)
    {
        $equipmentRepository = app(EquipmentRepository::class);
        $thisModelTable = $equipmentRepository->getModel()->getTable();

        $endDate = isset($searchCriteria['endDate']) ? Carbon::parse($searchCriteria['endDate']) : Carbon::now();
        $startDate = isset($searchCriteria['startDate']) ? Carbon::parse($searchCriteria['startDate']) : Carbon::now();

        $totals = DB::table($thisModelTable)
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when showOnWebsite = 1 then 1 end) as showOnWebsite")
            ->selectRaw("count(case when showOnLds = 1 then 1 end) as showOnLds")
            ->selectRaw("count(case when expireAt >= '". Carbon::now() ."' then 1 end) as active")
            ->selectRaw("count(case when expireAt <= '". Carbon::now() ."' then 1 end) as expired")
            ->whereDate( '.created_at', '<=', $endDate)
            ->whereDate( '.created_at', '>=', $startDate)
            ->where( '.propertyId', $searchCriteria['propertyId'])
            ->first();
        
        return $totals;

    }

}
