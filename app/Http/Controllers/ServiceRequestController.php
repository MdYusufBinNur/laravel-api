<?php

namespace App\Http\Controllers;

use App\DbModels\ServiceRequest;
use App\Http\Requests\ServiceRequest\IndexRequest;
use App\Http\Requests\ServiceRequest\StoreRequest;
use App\Http\Requests\ServiceRequest\UpdateRequest;
use App\Http\Resources\ServiceRequestResource;
use App\Http\Resources\ServiceRequestResourceCollection;
use App\Repositories\Contracts\ServiceRequestRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class ServiceRequestController extends Controller
{
    /**
     * @var ServiceRequestRepository
     */
    protected $serviceRequestRepository;

    /**
     * ServiceRequestController constructor.
     * @param ServiceRequestRepository $serviceRequestRepository
     */
    public function __construct(ServiceRequestRepository $serviceRequestRepository)
    {
        $this->serviceRequestRepository = $serviceRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ServiceRequestResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ServiceRequest::class, $request->get('propertyId'), $request->get('unitId', null)]);

        $serviceRequests = $this->serviceRequestRepository->findBy($request->all());

        return new ServiceRequestResourceCollection($serviceRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return ServiceRequestResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ServiceRequest::class, $request->get('propertyId'), $request->get('unitId', null)]);

        $serviceRequest = $this->serviceRequestRepository->save($request->all());

        return new ServiceRequestResource($serviceRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequest $serviceRequest
     * @return ServiceRequestResource
     * @throws AuthorizationException
     */
    public function show(ServiceRequest $serviceRequest)
    {
        $this->authorize('show', $serviceRequest);

        return new ServiceRequestResource($serviceRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ServiceRequest $serviceRequest
     * @return ServiceRequestResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ServiceRequest $serviceRequest)
    {
        $this->authorize('update', $serviceRequest);

        $serviceRequest = $this->serviceRequestRepository->update($serviceRequest,$request->all());

        return new ServiceRequestResource($serviceRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequest $serviceRequest
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        $this->authorize('destroy', $serviceRequest);

        $this->serviceRequestRepository->delete($serviceRequest);

        return response()->json(null,204);
    }
}
