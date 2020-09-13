<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\EquipmentMaintenance\ReportRequest;
use App\Http\Resources\Reporting\EquipmentMaintenanceResourceCollection;
use App\Http\Resources\Reporting\EquipmentMaintenanceStateResource;
use App\Services\Reporting\EquipmentMaintenance;
use App\Http\Controllers\Controller;

class EquipmentMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return EquipmentMaintenanceResourceCollection
     */
    public function index(ReportRequest $request)
    {
        $equipmentMaintenance = EquipmentMaintenance::index($request->all());

        return new EquipmentMaintenanceResourceCollection($equipmentMaintenance);
    }

    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return EquipmentMaintenanceStateResource
     */
    public function equipmentMaintenanceState(ReportRequest $request)
    {
        $equipmentMaintenanceState = EquipmentMaintenance::equipmentMaintenanceState($request->all());

        return new EquipmentMaintenanceStateResource($equipmentMaintenanceState);
    }

}
