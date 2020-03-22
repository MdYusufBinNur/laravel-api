<?php

namespace App\Http\Controllers;

use App\DbModels\ServiceRequestLog;
use App\Http\Requests\ServiceRequestLog\IndexRequest;
use App\Http\Requests\ServiceRequestLog\StoreRequest;
use App\Http\Requests\ServiceRequestLog\UpdateRequest;
use App\Http\Resources\ServiceRequestLogResource;
use App\Http\Resources\ServiceRequestLogResourceCollection;
use App\Repositories\Contracts\ServiceRequestLogRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ServiceRequestLog::class, $request->input('propertyId')]);

        $serviceRequestLogs = $this->serviceRequestLogRepository->findBy($request->all());

        return new ServiceRequestLogResourceCollection($serviceRequestLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ServiceRequestLogResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ServiceRequestLog::class, $request->input('propertyId')]);

        $serviceRequestLog = $this->serviceRequestLogRepository->save($request->all());

        return new ServiceRequestLogResource($serviceRequestLog);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequestLog $serviceRequestLog
     * @return ServiceRequestLogResource
     * @throws AuthorizationException
     */
    public function show(ServiceRequestLog $serviceRequestLog)
    {
        $this->authorize('show', $serviceRequestLog);

        return new ServiceRequestLogResource($serviceRequestLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ServiceRequestLog $serviceRequestLog
     * @return ServiceRequestLogResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ServiceRequestLog $serviceRequestLog)
    {
        $this->authorize('update', $serviceRequestLog);

        $serviceRequestLog = $this->serviceRequestLogRepository->update($serviceRequestLog,$request->all());

        return new ServiceRequestLogResource($serviceRequestLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequestLog $serviceRequestLog
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ServiceRequestLog $serviceRequestLog)
    {
        $this->authorize('destroy', $serviceRequestLog);

        $this->serviceRequestLogRepository->delete($serviceRequestLog);

        return response()->json(null,204);
    }
}
