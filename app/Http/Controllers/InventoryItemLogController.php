<?php

namespace App\Http\Controllers;

use App\DbModels\InventoryItemLog;
use App\Http\Requests\InventoryItemLog\IndexRequest;
use App\Http\Requests\InventoryItemLog\StoreRequest;
use App\Http\Requests\InventoryItemLog\UpdateRequest;
use App\Http\Resources\InventoryItemLogResource;
use App\Http\Resources\InventoryItemLogResourceCollection;
use App\Repositories\Contracts\InventoryItemLogRepository;
use Illuminate\Http\Request;

class InventoryItemLogController extends Controller
{
    /**
     * @var InventoryItemLogRepository
     */
    protected $inventoryItemLogRepository;

    public function __construct(InventoryItemLogRepository $inventoryItemLogRepository)
    {
        $this->inventoryItemLogRepository = $inventoryItemLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return InventoryItemLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $inventoryItemLogs = $this->inventoryItemLogRepository->findBy($request->all());

        return new InventoryItemLogResourceCollection($inventoryItemLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return InventoryItemLogResource
     */
    public function store(StoreRequest $request)
    {
        $inventoryItemLog = $this->inventoryItemLogRepository->save($request->all());

        return new InventoryItemLogResource($inventoryItemLog);
    }

    /**
     * Display the specified resource.
     *
     * @param InventoryItemLog $inventoryItemLog
     * @return InventoryItemLogResource
     */
    public function show(InventoryItemLog $inventoryItemLog)
    {
        return new InventoryItemLogResource($inventoryItemLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param InventoryItemLog $inventoryItemLog
     * @return InventoryItemLogResource
     */
    public function update(UpdateRequest $request, InventoryItemLog $inventoryItemLog)
    {
        $inventoryItemLog = $this->inventoryItemLogRepository->update($inventoryItemLog, $request->all());

        return new InventoryItemLogResource($inventoryItemLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InventoryItemLog $inventoryItemLog
     * @return void
     */
    public function destroy(InventoryItemLog $inventoryItemLog)
    {
        $this->inventoryItemLogRepository->delete($inventoryItemLog);

        return response()->json(null, 204);
    }
}
