<?php

namespace App\Http\Controllers;

use App\DbModels\Resident;
use App\Http\Requests\Resident\IndexRequest;
use App\Http\Requests\Resident\StoreRequest;
use App\Http\Requests\Resident\UpdateRequest;
use App\Http\Resources\ResidentResource;
use App\Http\Resources\ResidentResourceCollection;
use App\Repositories\Contracts\ResidentRepository;

class ResidentController extends Controller
{
    /**
     * @var ResidentRepository
     */
    protected $residentRepository;

    /**
     * ResidentController constructor.
     * @param ResidentRepository $residentRepository
     */
    public function __construct(ResidentRepository $residentRepository)
    {
        $this->residentRepository = $residentRepository;
    }

    /**
     * Display a listing of the  Resident resource.
     *
     * @param IndexRequest $request
     * @return ResidentResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $residents = $this->residentRepository->findBy($request->all());

        return new ResidentResourceCollection($residents);
    }

    /**
     * Store a newly created Resident resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ResidentResource
     */
    public function store(StoreRequest $request)
    {
        $resident = $this->residentRepository->save($request->all());

        return new ResidentResource($resident);
    }

    /**
     * Display the specified Resident resource.
     *
     * @param Resident $resident
     * @return ResidentResource
     */
    public function show(Resident $resident)
    {
        return new ResidentResource($resident);
    }

    /**
     * Update the specified Resident resource in storage.
     *
     * @param UpdateRequest $request
     * @param Resident $resident
     * @return ResidentResource
     */
    public function update(UpdateRequest $request, Resident $resident)
    {
        $resident = $this->residentRepository->update($resident, $request->all());

        return new ResidentResource($resident);
    }

    /**
     * Remove the specified Resident resource from storage.
     *
     * @param Resident $resident
     * @return null
     */
    public function destroy(Resident $resident)
    {
        $this->residentRepository->delete($resident);

        return response()->json(null, 204);
    }
}
