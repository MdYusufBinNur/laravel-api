<?php

namespace App\Http\Controllers;

use App\DbModels\ResidentEmergency;
use App\Http\Requests\ResidentEmergency\IndexRequest;
use App\Http\Requests\ResidentEmergency\StoreRequest;
use App\Http\Requests\ResidentEmergency\UpdateRequest;
use App\Http\Resources\ResidentEmergencyResource;
use App\Http\Resources\ResidentEmergencyResourceCollection;
use App\Repositories\Contracts\ResidentEmergencyRepository;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ResidentEmergency::class, $request->get('residentId')]);

        $residentEmergencies = $this->residentEmergencyRepository->findBy($request->all());

        return new ResidentEmergencyResourceCollection($residentEmergencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return ResidentEmergencyResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ResidentEmergency::class, $request->get('residentId')]);

        $residentEmergency = $this->residentEmergencyRepository->save($request->all());

        return new ResidentEmergencyResource($residentEmergency);
    }

    /**
     * Display the specified resource.
     *
     * @param ResidentEmergency $residentEmergency
     * @return ResidentEmergencyResource
     * @throws AuthorizationException
     */
    public function show(ResidentEmergency $residentEmergency)
    {
        $this->authorize('show', $residentEmergency);

        return new ResidentEmergencyResource($residentEmergency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ResidentEmergency $residentEmergency
     * @return ResidentEmergencyResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ResidentEmergency $residentEmergency)
    {
        $this->authorize('update', $residentEmergency);

        $residentEmergency = $this->residentEmergencyRepository->update($residentEmergency, $request->all());

        return new ResidentEmergencyResource($residentEmergency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentEmergency $residentEmergency
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ResidentEmergency $residentEmergency)
    {
        $this->authorize('destroy', $residentEmergency);

        $this->residentEmergencyRepository->delete($residentEmergency);

        return response()->json(null, 204);
    }
}
