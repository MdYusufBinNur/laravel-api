<?php

namespace App\Http\Controllers;

use App\DbModels\InventoryCategory;
use App\Http\Requests\InventoryCategory\IndexRequest;
use App\Http\Requests\InventoryCategory\StoreRequest;
use App\Http\Requests\InventoryCategory\UpdateRequest;
use App\Http\Resources\InventoryCategoryResource;
use App\Http\Resources\InventoryCategoryResourceCollection;
use App\Repositories\Contracts\InventoryCategoryRepository;

class InventoryCategoryController extends Controller
{
    /**
     * @var InventoryCategoryRepository
     */
    protected $inventoryCategoryRepository;

    /**
     * InventoryCategoryController constructor.
     * @param InventoryCategoryRepository $inventoryCategoryRepository
     */
    public function __construct(InventoryCategoryRepository $inventoryCategoryRepository)
    {
        $this->inventoryCategoryRepository = $inventoryCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return InventoryCategoryResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $inventoryCategories = $this->inventoryCategoryRepository->findBy($request->all());

        return new InventoryCategoryResourceCollection($inventoryCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return InventoryCategoryResource
     */
    public function store(StoreRequest $request)
    {
        $inventoryCategory = $this->inventoryCategoryRepository->save($request->all());

        return new InventoryCategoryResource($inventoryCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param InventoryCategory $inventoryCategory
     * @return InventoryCategoryResource
     */
    public function show(InventoryCategory $inventoryCategory)
    {
        return new InventoryCategoryResource($inventoryCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param InventoryCategory $inventoryCategory
     * @return InventoryCategoryResource
     */
    public function update(UpdateRequest $request, InventoryCategory $inventoryCategory)
    {
        $inventoryCategory = $this->inventoryCategoryRepository->update($inventoryCategory, $request->all());

        return new InventoryCategoryResource($inventoryCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InventoryCategory $inventoryCategory
     * @return void
     */
    public function destroy(InventoryCategory $inventoryCategory)
    {
        $this->inventoryCategoryRepository->delete($inventoryCategory);

        return response()->json(null, 204);
    }
}
