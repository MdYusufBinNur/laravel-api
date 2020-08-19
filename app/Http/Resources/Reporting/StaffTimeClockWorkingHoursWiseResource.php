<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class StaffTimeClockWorkingHoursWiseResource extends Resource
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
            'date' => $this->date,
            'day' => $this->day,
            'hours' => $this->hours,
        ];
    }
}
