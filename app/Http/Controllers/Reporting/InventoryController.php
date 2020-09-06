<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\Inventory\ReportRequest;
use App\Http\Resources\Reporting\InventoryResourceCollection;
use App\Http\Resources\Reporting\InventoryStateResource;
use App\Services\Reporting\Inventory;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return InventoryResourceCollection
     */
    public function index(ReportRequest $request)
    {
        $data = Inventory::index($request->all());

        return new InventoryResourceCollection($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return InventoryStateResource
     */
    public function inventoryState(ReportRequest $request)
    {
        $stateData = Inventory::inventoryState($request->all());

        return new InventoryStateResource($stateData);
    }

}
