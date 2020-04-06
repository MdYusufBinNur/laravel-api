<?php

namespace App\Http\Controllers;

use App\DbModels\InventoryItem;
use App\Http\Requests\InventoryItem\StoreRequest;
use App\Http\Requests\InventoryItem\IndexRequest;
use App\Http\Requests\InventoryItem\TransferRequest;
use App\Http\Requests\InventoryItem\UpdateRequest;
use App\Http\Resources\InventoryItemResource;
use App\Http\Resources\InventoryItemResourceCollection;
use App\Repositories\Contracts\InventoryItemRepository;

class InventoryItemController extends Controller
{

    /**
     * @var inventoryItemRepository
     */
    protected $inventoryItemRepository;

    /**
     * InventoryCategoryController constructor.
     * @param inventoryItemRepository $inventoryItemRepository
     */
    public function __construct(InventoryItemRepository $inventoryItemRepository)
    {
        $this->inventoryItemRepository = $inventoryItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return InventoryItemResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $inventoryItems = $this->inventoryItemRepository->findBy($request->all());

        return new InventoryItemResourceCollection($inventoryItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return InventoryItemResource
     */
    public function store(StoreRequest $request)
    {
        $inventoryItem = $this->inventoryItemRepository->save($request->all());

        return new InventoryItemResource($inventoryItem);
    }

    /**
     * Display the specified resource.
     *
     * @param InventoryItem $inventoryItem
     * @return InventoryItemResource
     */
    public function show(InventoryItem $inventoryItem)
    {
        return new InventoryItemResource($inventoryItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param InventoryItem $inventoryItem
     * @return InventoryItemResource
     */
    public function update(UpdateRequest $request, InventoryItem $inventoryItem)
    {
        $inventoryItem = $this->inventoryItemRepository->update($inventoryItem, $request->all());

        return new InventoryItemResource($inventoryItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InventoryItem $inventoryItem
     * @return void
     */
    public function destroy(InventoryItem $inventoryItem)
    {
        $this->inventoryItemRepository->delete($inventoryItem);

        return response()->json(null, 204);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param TransferRequest $request
     * @param InventoryItem $inventoryItem
     * @return InventoryItemResource
     */
    public function transfer(TransferRequest $request)
    {
        $inventoryItem = $this->inventoryItemRepository->transfer($request->all());

        return new InventoryItemResource($inventoryItem);
    }

}
