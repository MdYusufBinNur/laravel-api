<?php

namespace App\Http\Resources\Stats;


use App\Http\Resources\Resource;

class StaffReminderResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'openServiceRequestCount' => $this->resource['openServiceRequestCount'],
            'openServiceRequestWeekCount' => $this->resource['openServiceRequestWeekCount'],
            'pendingResidentRequestsCount' => $this->resource['pendingResidentRequestsCount'],
            'pendingResidentRequestsWeekCount' => $this->resource['pendingResidentRequestsWeekCount'],
            'unArchivedPackagesCount' => $this->resource['unArchivedPackagesCount'],
            'unArchivedPackagesWeekCount' => $this->resource['unArchivedPackagesWeekCount'],
            'pendingTaskCount' => $this->resource['pendingTaskCount'],
            'pendingTaskWeekCount' => $this->resource['pendingTaskWeekCount'],
            'contentApprovalCount' => $this->resource['contentApprovalCount'],
            'contentApprovalWeekCount' => $this->resource['contentApprovalWeekCount'],
        ];
    }
}
