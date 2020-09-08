<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\ParkingManagement\ReportRequest;
use App\Http\Resources\Reporting\ParkingMangementResourceCollection;
use App\Http\Resources\Reporting\ParkingMangementStateResource;
use App\Services\Reporting\ParkingManagement;
use App\Http\Controllers\Controller;

class ParkingManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return ParkingMangementResourceCollection
     */
    public function index(ReportRequest $request)
    {
        $data = ParkingManagement::index($request->all());

        return new ParkingMangementResourceCollection($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return ParkingMangementStateResource
     */
    public function parkingState(ReportRequest $request)
    {
        $stateData = ParkingManagement::parkingState($request->all());

        return new ParkingMangementStateResource($stateData);
    }
}
