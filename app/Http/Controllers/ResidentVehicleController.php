<?php

namespace App\Http\Controllers;

use App\DbModels\ResidentVehicle;
use App\Http\Requests\ResidentVehicle\IndexRequest;
use App\Http\Requests\ResidentVehicle\StoreRequest;
use App\Http\Requests\ResidentVehicle\UpdateRequest;
use App\Http\Resources\ResidentVehicleResource;
use App\Http\Resources\ResidentVehicleResourceCollection;
use App\Repositories\Contracts\ResidentVehicleRepository;
use Illuminate\Http\Request;

class ResidentVehicleController extends Controller
{
    /**
     * @var ResidentVehicleRepository
     */
    protected $residentVehicleRepository;

    /**
     * ResidentVehicleController constructor.
     * @param ResidentVehicleRepository $residentVehicleRepository
     */
    public function __construct(ResidentVehicleRepository $residentVehicleRepository)
    {
        $this->residentVehicleRepository = $residentVehicleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ResidentVehicleResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $residentVehicles = $this->residentVehicleRepository->findBy($request->all());

        return new ResidentVehicleResourceCollection($residentVehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ResidentVehicleResource
     */
    public function store(StoreRequest $request)
    {
        $residentVehicle = $this->residentVehicleRepository->save($request->all());

        return new ResidentVehicleResource($residentVehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param ResidentVehicle $residentVehicle
     * @return ResidentVehicleResource
     */
    public function show(ResidentVehicle $residentVehicle)
    {
        return new ResidentVehicleResource($residentVehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ResidentVehicle $residentVehicle
     * @return ResidentVehicleResource
     */
    public function update(UpdateRequest $request, ResidentVehicle $residentVehicle)
    {
        $residentVehicle = $this->residentVehicleRepository->update($residentVehicle, $request->all());

        return new ResidentVehicleResource($residentVehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentVehicle $residentVehicle
     * @return void
     */
    public function destroy(ResidentVehicle $residentVehicle)
    {
        $this->residentVehicleRepository->delete($residentVehicle);

        return response()->json(null, 204);
    }
}
