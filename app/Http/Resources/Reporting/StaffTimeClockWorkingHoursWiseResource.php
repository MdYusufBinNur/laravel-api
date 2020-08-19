<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use Carbon\Carbon;
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
        $startTime = Carbon::parse($this->clockedIn);
        $endTime = $this->clockedOut ? Carbon::parse($this->clockedOut) : $this->clockedIn;
        $diffInHours = $startTime->diffInHours($endTime);

        return [
            'date' => $startTime,
            'hours' => $diffInHours,
        ];
    }
}
