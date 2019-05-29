<?php

namespace App\Http\Controllers;

use App\DbModels\ServiceRequestStatus;
use App\Http\Requests\ServiceRequestStatus\IndexRequest;
use App\Http\Requests\ServiceRequestStatus\StoreRequest;
use App\Http\Requests\ServiceRequestStatus\UpdateRequest;
use App\Http\Resources\ServiceRequestStatusResource;
use App\Http\Resources\ServiceRequestStatusResourceCollection;
use App\Repositories\Contracts\ServiceRequestStatusRepository;

class ServiceRequestStatusController extends Controller
{
    /**
     * @var ServiceRequestStatusRepository
     */
    protected $serviceRequestStatusRepository;

    /**
     * ServiceRequestStatusController constructor.
     * @param ServiceRequestStatusRepository $serviceRequestStatusRepository
     */
    public function __construct(ServiceRequestStatusRepository $serviceRequestStatusRepository)
    {
        $this->serviceRequestStatusRepository = $serviceRequestStatusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ServiceRequestStatusResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $serviceRequestStatuses = $this->serviceRequestStatusRepository->findBy($request->all());

        return new ServiceRequestStatusResourceCollection($serviceRequestStatuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ServiceRequestStatusResource
     */
    public function store(StoreRequest $request)
    {
        $serviceRequestStatus = $this->serviceRequestStatusRepository->save($request->all());

        return new ServiceRequestStatusResource($serviceRequestStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequestStatus $serviceRequestStatus
     * @return ServiceRequestStatusResource
     */
    public function show(ServiceRequestStatus $serviceRequestStatus)
    {
        return new ServiceRequestStatusResource($serviceRequestStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ServiceRequestStatus $serviceRequestStatus
     * @return ServiceRequestStatusResource
     */
    public function update(UpdateRequest $request, ServiceRequestStatus $serviceRequestStatus)
    {
        $serviceRequestStatus = $this->serviceRequestStatusRepository->update($serviceRequestStatus,$request->all());

        return new ServiceRequestStatusResource($serviceRequestStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequestStatus $serviceRequestStatus
     * @return void
     */
    public function destroy(ServiceRequestStatus $serviceRequestStatus)
    {
        $this->serviceRequestStatusRepository->delete($serviceRequestStatus);

        return response()->json(null,204);
    }
}
