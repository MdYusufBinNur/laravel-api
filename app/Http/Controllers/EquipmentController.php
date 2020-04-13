<?php

namespace App\Http\Controllers;

use App\DbModels\Equipment;
use App\Http\Requests\Equipment\IndexRequest;
use App\Http\Requests\Equipment\StoreRequest;
use App\Http\Requests\Equipment\UpdateRequest;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\EquipmentResourceCollection;
use App\Repositories\Contracts\EquipmentRepository;
use Illuminate\Auth\Access\AuthorizationException;

class EquipmentController extends Controller
{
    /**
     * @var EquipmentRepository
     */
    protected $equipmentRepository;

    /**
     * EquipmentController constructor.
     * @param EquipmentRepository $equipmentRepository
     */
    public function __construct(EquipmentRepository $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return EquipmentResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Equipment::class, $request->input('propertyId')]);

        $equipments = $this->equipmentRepository->findBy($request->all());

        return new EquipmentResourceCollection($equipments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return EquipmentResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Equipment::class, $request->input('propertyId')]);

        $equipment = $this->equipmentRepository->save($request->all());

        return new EquipmentResource($equipment);
    }

    /**
     * Display the specified resource.
     *
     * @param Equipment $equipment
     * @return EquipmentResource
     * @throws AuthorizationException
     */
    public function show(Equipment $equipment)
    {
        $this->authorize('show', $equipment);

        return new EquipmentResource($equipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Equipment $equipment
     * @return EquipmentResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Equipment $equipment)
    {
        $this->authorize('update', $equipment);

        $equipment = $this->equipmentRepository->update($equipment, $request->all());

        return new EquipmentResource($equipment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Equipment $equipment
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(Equipment $equipment)
    {
        $this->authorize('destroy', $equipment);

        $this->equipmentRepository->delete($equipment);

        return response()->json(null, 204);
    }
}
