<?php

namespace App\Http\Controllers;

use App\DbModels\Equipment;
use App\Http\Requests\Equipment\IndexRequest;
use App\Http\Requests\Equipment\StoreRequest;
use App\Http\Requests\Equipment\UpdateRequest;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\EquipmentResourceCollection;
use App\Repositories\Contracts\EquipmentRepository;

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
     */
    public function index(IndexRequest $request)
    {
        $equipments = $this->equipmentRepository->findBy($request->all());

        return new EquipmentResourceCollection($equipments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return EquipmentResource
     */
    public function store(StoreRequest $request)
    {
        $equipment = $this->equipmentRepository->save($request->all());

        return new EquipmentResource($equipment);
    }

    /**
     * Display the specified resource.
     *
     * @param Equipment $equipment
     * @return EquipmentResource
     */
    public function show(Equipment $equipment)
    {
        return new EquipmentResource($equipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Equipment $equipment
     * @return EquipmentResource
     */
    public function update(UpdateRequest $request, Equipment $equipment)
    {
        $equipment = $this->equipmentRepository->update($equipment, $request->all());

        return new EquipmentResource($equipment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $this->equipmentRepository->delete($equipment);

        return response()->json(null, 204);
    }
}
