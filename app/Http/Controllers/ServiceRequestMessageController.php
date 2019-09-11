<?php

namespace App\Http\Controllers;

use App\DbModels\ServiceRequestMessage;
use App\Http\Requests\ServiceRequestMessage\IndexRequest;
use App\Http\Requests\ServiceRequestMessage\StoreRequest;
use App\Http\Requests\ServiceRequestMessage\UpdateRequest;
use App\Http\Resources\ServiceRequestMessageResource;
use App\Http\Resources\ServiceRequestMessageResourceCollection;
use App\Repositories\Contracts\ServiceRequestMessageRepository;

class ServiceRequestMessageController extends Controller
{
    /**
     * @var ServiceRequestMessageRepository
     */
    protected $serviceRequestMessageRepository;

    /**
     * ServiceRequestMessageController constructor.
     * @param ServiceRequestMessageRepository $serviceRequestMessageRepository
     */
    public function __construct(ServiceRequestMessageRepository $serviceRequestMessageRepository)
    {
        $this->serviceRequestMessageRepository = $serviceRequestMessageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ServiceRequestMessageResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $serviceRequestMessages = $this->serviceRequestMessageRepository->findBy($request->all());

        return new ServiceRequestMessageResourceCollection($serviceRequestMessages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ServiceRequestMessageResource
     */
    public function store(StoreRequest $request)
    {
        $serviceRequestMessage = $this->serviceRequestMessageRepository->save($request->all());

        return new ServiceRequestMessageResource($serviceRequestMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequestMessage $serviceRequestMessage
     * @return ServiceRequestMessageResource
     */
    public function show(ServiceRequestMessage $serviceRequestMessage)
    {
        return new ServiceRequestMessageResource($serviceRequestMessage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ServiceRequestMessage $serviceRequestMessage
     * @return ServiceRequestMessageResource
     */
    public function update(UpdateRequest $request, ServiceRequestMessage $serviceRequestMessage)
    {
        $serviceRequestMessage = $this->serviceRequestMessageRepository->update($serviceRequestMessage, $request->all());

        return new ServiceRequestMessageResource($serviceRequestMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequestMessage $serviceRequestMessage
     * @return void
     */
    public function destroy(ServiceRequestMessage $serviceRequestMessage)
    {
        $this->serviceRequestMessageRepository->delete($serviceRequestMessage);

        return response()->json(null, 204);
    }
}
