<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\StaffTimeClock\ReportRequest;
use App\Http\Resources\Reporting\StaffTimeClockMonthWiseResourceCollection;
use App\Http\Resources\Reporting\StaffTimeClockStateResource;
use App\Http\Resources\Reporting\StaffTimeClockWorkingHoursWiseResourceCollection;
use App\Services\Reporting\StaffTimeClock;
use App\Http\Controllers\Controller;

class StaffTimeClockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return StaffTimeClockStateResource
     */
    public function index(ReportRequest $request)
    {
        $stateData = StaffTimeClock::staffTimeClockStats($request->all());

        return new StaffTimeClockStateResource($stateData);
    }

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

    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return StaffTimeClockWorkingHoursWiseResourceCollection
     */
    public function getWorkingHoursWiseStaffAttendance(ReportRequest $request)
    {
        $workingHoursWiseAttendanceCount = StaffTimeClock::fetchWorkingHoursWiseStaffAttendance($request->all());

        return new StaffTimeClockWorkingHoursWiseResourceCollection($workingHoursWiseAttendanceCount);
    }
}
