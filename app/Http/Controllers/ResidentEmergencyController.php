<?php

namespace App\Http\Controllers;

use App\DbModels\ResidentEmergency;
use App\Http\Requests\ResidentEmergency\IndexRequest;
use App\Http\Requests\ResidentEmergency\StoreRequest;
use App\Http\Requests\ResidentEmergency\UpdateRequest;
use App\Http\Resources\ResidentEmergencyResource;
use App\Http\Resources\ResidentEmergencyResourceCollection;
use App\Repositories\Contracts\ResidentEmergencyRepository;
use Illuminate\Http\Request;

class ResidentEmergencyController extends Controller
{
    /**
     * @var ResidentEmergencyRepository
     */
    protected $residentEmergencyRepository;

    /**
     * ResidentEmergencyController constructor.
     * @param ResidentEmergencyRepository $residentEmergencyRepository
     */
    public function __construct(ResidentEmergencyRepository $residentEmergencyRepository)
    {
        $this->residentEmergencyRepository = $residentEmergencyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ResidentEmergencyResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $residentEmergencies = $this->residentEmergencyRepository->findBy($request->all());

        return new ResidentEmergencyResourceCollection($residentEmergencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return ResidentEmergencyResource
     */
    public function store(StoreRequest $request)
    {
        $residentEmergency = $this->residentEmergencyRepository->save($request->all());

        return new ResidentEmergencyResource($residentEmergency);
    }

    /**
     * Display the specified resource.
     *
     * @param ResidentEmergency $residentEmergency
     * @return ResidentEmergencyResource
     */
    public function show(ResidentEmergency $residentEmergency)
    {
        return new ResidentEmergencyResource($residentEmergency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ResidentEmergency $residentEmergency
     * @return ResidentEmergencyResource
     */
    public function update(UpdateRequest $request, ResidentEmergency $residentEmergency)
    {
        $residentEmergency = $this->residentEmergencyRepository->update($residentEmergency, $request->all());

        return new ResidentEmergencyResource($residentEmergency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentEmergency $residentEmergency
     * @return void
     */
    public function destroy(ResidentEmergency $residentEmergency)
    {
        $this->residentEmergencyRepository->delete($residentEmergency);

        return response()->json(null, 204);
    }
}
