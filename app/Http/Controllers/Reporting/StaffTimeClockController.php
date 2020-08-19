<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\StaffTimeClock\ReportRequest;
use App\Http\Resources\Reporting\StaffTimeClockMonthWiseResourceCollection;
use App\Services\Reporting\StaffTimeClock;
use App\Http\Controllers\Controller;

class StaffTimeClockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return StaffTimeClockMonthWiseResourceCollection
     */
    public function getMonthWiseStaffAttendance(ReportRequest $request)
    {
        $monthWiseAttendanceCount = StaffTimeClock::fetchMonthWiseStaffAttendance($request->all());

        return new StaffTimeClockMonthWiseResourceCollection($monthWiseAttendanceCount);
    }
}
