<?php

namespace App\Http\Controllers;

use App\DbModels\Resident;
use App\Http\Requests\Resident\DestroyRequest;
use App\Http\Requests\Resident\IndexRequest;
use App\Http\Requests\Resident\StoreRequest;
use App\Http\Requests\Resident\TransferResidentRequest;
use App\Http\Requests\Resident\UpdateRequest;
use App\Http\Resources\ResidentResource;
use App\Http\Resources\ResidentResourceCollection;
use App\Repositories\Contracts\ResidentRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Resident::class, $request->get('propertyId')]);

        $residents = $this->residentRepository->findBy($request->all());

        return new ResidentResourceCollection($residents);
    }

    /**
     * Store a newly created Resident resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ResidentResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', Resident::class);

        $resident = $this->residentRepository->save($request->all());

        return new ResidentResource($resident);
    }

    /**
     * Display the specified Resident resource.
     *
     * @param Resident $resident
     * @return ResidentResource
     * @throws AuthorizationException
     */
    public function show(Resident $resident)
    {
        $this->authorize('show', $resident);

        return new ResidentResource($resident);
    }

    /**
     * Update the specified Resident resource in storage.
     *
     * @param UpdateRequest $request
     * @param Resident $resident
     * @return ResidentResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Resident $resident)
    {
        $this->authorize('update', $resident);

        $resident = $this->residentRepository->update($resident, $request->all());

        return new ResidentResource($resident);
    }

    /**
     * Remove the specified Resident resource from storage.
     *
     * @param DestroyRequest $request
     * @param Resident $resident
     * @return null
     * @throws AuthorizationException
     */
    public function destroy(DestroyRequest $request, Resident $resident)
    {
        $this->authorize('destroy', $resident);

        $this->residentRepository->deleteResident($resident, $request->all());

        return response()->json(null, 204);
    }


    /**
     * @param TransferResidentRequest $request
     * @return ResidentResourceCollection
     * @throws AuthorizationException
     */
    public function residentTransfer(TransferResidentRequest $request)
    {
        $this->authorize('residentTransfer', [Resident::class, $request->get('propertyId')]);

        $residents = $this->residentRepository->transferResidents($request->all());

        return new ResidentResourceCollection($residents);
    }
}
