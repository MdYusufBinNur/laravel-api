<?php

namespace App\Http\Controllers;

use App\DbModels\EquipmentMaintenanceLog;
use App\Http\Requests\EquipmentMaintenanceLog\IndexRequest;
use App\Http\Requests\EquipmentMaintenanceLog\StoreRequest;
use App\Http\Requests\EquipmentMaintenanceLog\UpdateRequest;
use App\Http\Resources\EquipmentMaintenanceLogResource;
use App\Http\Resources\EquipmentMaintenanceLogResourceCollection;
use App\Repositories\Contracts\EquipmentMaintenanceLogRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [EquipmentMaintenanceLog::class, $request->input('propertyId')]);

        $equipmentMaintenanceLogs = $this->equipmentMaintenanceLogRepository->findBy($request->all());

        return new EquipmentMaintenanceLogResourceCollection($equipmentMaintenanceLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return EquipmentMaintenanceLogResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [EquipmentMaintenanceLog::class, $request->input('propertyId')]);

        $equipmentMaintenanceLog = $this->equipmentMaintenanceLogRepository->save($request->all());

        return new EquipmentMaintenanceLogResource($equipmentMaintenanceLog);
    }

    /**
     * Display the specified resource.
     *
     * @param EquipmentMaintenanceLog $equipmentMaintenanceLog
     * @return EquipmentMaintenanceLogResource
     * @throws AuthorizationException
     */
    public function show(EquipmentMaintenanceLog $equipmentMaintenanceLog)
    {
        $this->authorize('show', $equipmentMaintenanceLog);

        return new EquipmentMaintenanceLogResource($equipmentMaintenanceLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param EquipmentMaintenanceLog $equipmentMaintenanceLog
     * @return EquipmentMaintenanceLogResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, EquipmentMaintenanceLog $equipmentMaintenanceLog)
    {
        $this->authorize('update', $equipmentMaintenanceLog);

        $equipmentMaintenanceLog = $this->equipmentMaintenanceLogRepository->update($equipmentMaintenanceLog, $request->all());

        return new EquipmentMaintenanceLogResource($equipmentMaintenanceLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EquipmentMaintenanceLog $equipmentMaintenanceLog
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(EquipmentMaintenanceLog $equipmentMaintenanceLog)
    {
        $this->authorize('destroy', $equipmentMaintenanceLog);

        $this->equipmentMaintenanceLogRepository->delete($equipmentMaintenanceLog);

        return response()->json(null, 204);
    }
}
