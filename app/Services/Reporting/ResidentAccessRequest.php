<?php


namespace App\Services\Reporting;

use App\Repositories\Contracts\InventoryItemRepository;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ResidentAccessRequest
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
     * get resident access request states
     *
     * @param $searchCriteria
     * @return Model|Builder|object
     */
    public static function residentAccessRequestState($searchCriteria)
    {
        $residentAccessRequestRepository = app(ResidentAccessRequestRepository::class);
        $thisModelTable = $residentAccessRequestRepository->getModel()->getTable();

        $totals = DB::table($thisModelTable)
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when status = 'approved' then 1 end) as approved")
            ->selectRaw("count(case when status = 'denied' then 1 end) as denied")
            ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
            ->selectRaw("count(case when status = 'completed' then 1 end) as completed")
            ->first();

        return $totals;

    }

}
