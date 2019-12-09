<?php

namespace App\Http\Controllers;

use App\DbModels\ServiceRequestOfficeDetail;
use App\Http\Requests\ServiceRequestOfficeDetail\IndexRequest;
use App\Http\Requests\ServiceRequestOfficeDetail\StoreRequest;
use App\Http\Requests\ServiceRequestOfficeDetail\UpdateRequest;
use App\Http\Resources\ServiceRequestOfficeDetailResource;
use App\Http\Resources\ServiceRequestOfficeDetailResourceCollection;
use App\Repositories\Contracts\ServiceRequestOfficeDetailRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ServiceRequestOfficeDetailController extends Controller
{
    /**
     * @var ServiceRequestOfficeDetailRepository
     */
    protected $serviceRequestOfficeDetailRepository;

    /**
     * ServiceRequestOfficeDetailController constructor.
     * @param ServiceRequestOfficeDetailRepository $serviceRequestOfficeDetailRepository
     */
    public function __construct(ServiceRequestOfficeDetailRepository $serviceRequestOfficeDetailRepository)
    {
        $this->serviceRequestOfficeDetailRepository = $serviceRequestOfficeDetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ServiceRequestOfficeDetailResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ServiceRequestOfficeDetail::class, $request->get('propertyId')]);

        $serviceRequestOfficeDetails = $this->serviceRequestOfficeDetailRepository->findBy($request->all());

        return new ServiceRequestOfficeDetailResourceCollection($serviceRequestOfficeDetails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ServiceRequestOfficeDetailResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ServiceRequestOfficeDetail::class, $request->get('propertyId')]);

        $serviceRequestOfficeDetail = $this->serviceRequestOfficeDetailRepository->setServiceRequestOfficeDetail($request->all());

        return new ServiceRequestOfficeDetailResource($serviceRequestOfficeDetail);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequestOfficeDetail $serviceRequestOfficeDetail
     * @return ServiceRequestOfficeDetailResource
     * @throws AuthorizationException
     */
    public function show(ServiceRequestOfficeDetail $serviceRequestOfficeDetail)
    {
        $this->authorize('show', $serviceRequestOfficeDetail);

        return new ServiceRequestOfficeDetailResource($serviceRequestOfficeDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ServiceRequestOfficeDetail $serviceRequestOfficeDetail
     * @return ServiceRequestOfficeDetailResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ServiceRequestOfficeDetail $serviceRequestOfficeDetail)
    {
        $this->authorize('update', $serviceRequestOfficeDetail);

        $serviceRequestOfficeDetail = $this->serviceRequestOfficeDetailRepository->update($serviceRequestOfficeDetail,$request->all());

        return new ServiceRequestOfficeDetailResource($serviceRequestOfficeDetail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequestOfficeDetail $serviceRequestOfficeDetail
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(ServiceRequestOfficeDetail $serviceRequestOfficeDetail)
    {
        $this->authorize('update', $serviceRequestOfficeDetail);

        $this->serviceRequestOfficeDetailRepository->delete($serviceRequestOfficeDetail);

        return response()->json(null,204);
    }
}
