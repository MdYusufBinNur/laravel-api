<?php

namespace App\Http\Controllers;

use App\DbModels\ServiceRequestLog;
use App\Http\Requests\ServiceRequestLog\IndexRequest;
use App\Http\Requests\ServiceRequestLog\StoreRequest;
use App\Http\Requests\ServiceRequestLog\UpdateRequest;
use App\Http\Resources\ServiceRequestLogResource;
use App\Http\Resources\ServiceRequestLogResourceCollection;
use App\Repositories\Contracts\ServiceRequestLogRepository;

class ServiceRequestLogController extends Controller
{
    /**
     * @var ServiceRequestLogRepository
     */
    protected $serviceRequestLogRepository;

    /**
     * ServiceRequestLogController constructor.
     * @param ServiceRequestLogRepository $serviceRequestLogRepository
     */
    public function __construct(ServiceRequestLogRepository $serviceRequestLogRepository)
    {
        $this->serviceRequestLogRepository = $serviceRequestLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ServiceRequestLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $serviceRequestLogs = $this->serviceRequestLogRepository->findBy($request->all());

        return new ServiceRequestLogResourceCollection($serviceRequestLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ServiceRequestLogResource
     */
    public function store(StoreRequest $request)
    {
        $serviceRequestLog = $this->serviceRequestLogRepository->save($request->all());

        return new ServiceRequestLogResource($serviceRequestLog);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequestLog $serviceRequestLog
     * @return ServiceRequestLogResource
     */
    public function show(ServiceRequestLog $serviceRequestLog)
    {
        return new ServiceRequestLogResource($serviceRequestLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ServiceRequestLog $serviceRequestLog
     * @return ServiceRequestLogResource
     */
    public function update(UpdateRequest $request, ServiceRequestLog $serviceRequestLog)
    {
        $serviceRequestLog = $this->serviceRequestLogRepository->update($serviceRequestLog,$request->all());

        return new ServiceRequestLogResource($serviceRequestLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequestLog $serviceRequestLog
     * @return void
     */
    public function destroy(ServiceRequestLog $serviceRequestLog)
    {
        $this->serviceRequestLogRepository->delete($serviceRequestLog);

        return response()->json(null,204);
    }
}
