<?php

namespace App\Http\Controllers;

use App\DbModels\ResidentVehicle;
use App\Http\Requests\ResidentVehicle\IndexRequest;
use App\Http\Requests\ResidentVehicle\StoreRequest;
use App\Http\Requests\ResidentVehicle\UpdateRequest;
use App\Http\Resources\ResidentVehicleResource;
use App\Http\Resources\ResidentVehicleResourceCollection;
use App\Repositories\Contracts\ResidentVehicleRepository;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ResidentVehicle::class, $request->get('residentId')]);

        $residentVehicles = $this->residentVehicleRepository->findBy($request->all());

        return new ResidentVehicleResourceCollection($residentVehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ResidentVehicleResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ResidentVehicle::class, $request->get('residentId')]);

        $residentVehicle = $this->residentVehicleRepository->save($request->all());

        return new ResidentVehicleResource($residentVehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param ResidentVehicle $residentVehicle
     * @return ResidentVehicleResource
     * @throws AuthorizationException
     */
    public function show(ResidentVehicle $residentVehicle)
    {
        $this->authorize('show', $residentVehicle);

        return new ResidentVehicleResource($residentVehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ResidentVehicle $residentVehicle
     * @return ResidentVehicleResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ResidentVehicle $residentVehicle)
    {
        $this->authorize('update', $residentVehicle);

        $residentVehicle = $this->residentVehicleRepository->update($residentVehicle, $request->all());

        return new ResidentVehicleResource($residentVehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentVehicle $residentVehicle
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ResidentVehicle $residentVehicle)
    {
        $this->authorize('destroy', $residentVehicle);

        $this->residentVehicleRepository->delete($residentVehicle);

        return response()->json(null, 204);
    }
}
