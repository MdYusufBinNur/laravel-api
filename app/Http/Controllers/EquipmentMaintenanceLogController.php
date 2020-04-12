<?php

namespace App\Http\Controllers;

use App\DbModels\EquipmentMaintenanceLog;
use App\Http\Requests\EquipmentMaintenanceLog\IndexRequest;
use App\Http\Requests\EquipmentMaintenanceLog\StoreRequest;
use App\Http\Requests\EquipmentMaintenanceLog\UpdateRequest;
use App\Http\Resources\EquipmentMaintenanceLogResource;
use App\Http\Resources\EquipmentMaintenanceLogResourceCollection;
use App\Repositories\Contracts\EquipmentMaintenanceLogRepository;

class EquipmentMaintenanceLogController extends Controller
{
    /**
     * @var EquipmentMaintenanceLogRepository
     */
    protected $equipmentMaintenanceLogRepository;

    /**
     * EquipmentMaintenanceLogController constructor.
     * @param EquipmentMaintenanceLogRepository $equipmentMaintenanceLogRepository
     */
    public function __construct(EquipmentMaintenanceLogRepository $equipmentMaintenanceLogRepository)
    {
        $this->equipmentMaintenanceLogRepository = $equipmentMaintenanceLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return EquipmentMaintenanceLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $equipmentMaintenanceLogs = $this->equipmentMaintenanceLogRepository->findBy($request->all());

        return new EquipmentMaintenanceLogResourceCollection($equipmentMaintenanceLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return EquipmentMaintenanceLogResource
     */
    public function store(StoreRequest $request)
    {
        $equipmentMaintenanceLog = $this->equipmentMaintenanceLogRepository->save($request->all());

        return new EquipmentMaintenanceLogResource($equipmentMaintenanceLog);
    }

    /**
     * Display the specified resource.
     *
     * @param EquipmentMaintenanceLog $equipmentMaintenanceLog
     * @return EquipmentMaintenanceLogResource
     */
    public function show(EquipmentMaintenanceLog $equipmentMaintenanceLog)
    {
        return new EquipmentMaintenanceLogResource($equipmentMaintenanceLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param EquipmentMaintenanceLog $equipmentMaintenanceLog
     * @return EquipmentMaintenanceLogResource
     */
    public function update(UpdateRequest $request, EquipmentMaintenanceLog $equipmentMaintenanceLog)
    {
        $equipmentMaintenanceLog = $this->equipmentMaintenanceLogRepository->update($equipmentMaintenanceLog, $request->all());

        return new EquipmentMaintenanceLogResource($equipmentMaintenanceLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EquipmentMaintenanceLog $equipmentMaintenanceLog
     * @return void
     */
    public function destroy(EquipmentMaintenanceLog $equipmentMaintenanceLog)
    {
        $this->equipmentMaintenanceLogRepository->delete($equipmentMaintenanceLog);

        return response()->json(null, 204);
    }
}
