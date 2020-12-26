<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\ParkingManagement\ReportRequest;
use App\Http\Resources\Reporting\ParkingManagementResourceCollection;
use App\Http\Resources\Reporting\ParkingManagementStateResource;
use App\Services\Reporting\ParkingManagement;
use App\Http\Controllers\Controller;

class ParkingManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return ParkingManagementResourceCollection
     */
    public function index(ReportRequest $request)
    {
        $data = ParkingManagement::index($request->all());

        return new ParkingManagementResourceCollection($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return ParkingManagementStateResource
     */
    public function parkingState(ReportRequest $request)
    {
        $stateData = ParkingManagement::parkingState($request->all());

        return new ParkingManagementStateResource($stateData);
    }
}