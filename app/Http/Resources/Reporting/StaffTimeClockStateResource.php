<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;

class StaffTimeClockStateResource extends Resource
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
            'daysWorkedInAYearCount' => $this->resource['daysWorkedInAYearCount'],
            'hoursWorkedInAMonth' => $this->resource['hoursWorkedInAMonth'],
            'topPerformerOfADay' => $this->resource['topPerformerOfADay'],
        ];
    }
}
