<?php


namespace App\Services\Reporting;

use App\Repositories\Contracts\ResidentAccessRequestRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ResidentAccessRequest
{
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

        $endDate = isset($searchCriteria['endDate']) ? Carbon::parse($searchCriteria['endDate']) : Carbon::now();
        $startDate = isset($searchCriteria['startDate']) ? Carbon::parse($searchCriteria['startDate']) : Carbon::now();

        $totals = DB::table($thisModelTable)
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when status = 'approved' then 1 end) as approved")
            ->selectRaw("count(case when status = 'denied' then 1 end) as denied")
            ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
            ->selectRaw("count(case when status = 'completed' then 1 end) as completed")
            ->whereDate( '.created_at', '<=', $endDate)
            ->whereDate( '.created_at', '>=', $startDate)
            ->where( '.propertyId', $searchCriteria['propertyId'])
            ->first();
        return $totals;

    }

}
