<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;

class StaffTimeClockMonthWiseResource extends Resource
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
            'month' => $this->month,
            'days' => $this->days
        ];
    }
}
