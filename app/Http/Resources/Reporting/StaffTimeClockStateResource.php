<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class StaffTimeClockStateResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
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
