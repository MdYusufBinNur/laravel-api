<?php

namespace App\Http\Controllers;

use App\DbModels\ParkingPassLog;
use App\Http\Requests\ParkingPassLog\StoreRequest;
use App\Http\Requests\ParkingPassLog\IndexRequest;
use App\Http\Resources\ParkingPassLogResource;
use App\Http\Resources\ParkingPassLogResourceCollection;
use App\Repositories\Contracts\ParkingPassLogRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ParkingPassLogController extends Controller
{
    /**
     * @var ParkingPassLogRepository
     */
    protected $parkingPassLogRepository;

    /**
     * ParkingPassLogController constructor.
     * @param ParkingPassLogRepository $parkingPassLogRepository
     */
    public function __construct(ParkingPassLogRepository $parkingPassLogRepository)
    {
        $this->parkingPassLogRepository = $parkingPassLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ParkingPassLogResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ParkingPassLog::class, $request->get('propertyId'), $request->get('unitId', null)]);

        $parkingPassLogs = $this->parkingPassLogRepository->findBy($request->all());

        return new ParkingPassLogResourceCollection($parkingPassLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ParkingPassLogResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('list', ParkingPassLog::class);

        $parkingPassLog = $this->parkingPassLogRepository->save($request->all());

        return new ParkingPassLogResource($parkingPassLog);
    }

    /**
     * Display the specified resource.
     *
     * @param ParkingPassLog $parkingPassLog
     * @return ParkingPassLogResource
     * @throws AuthorizationException
     */
    public function show(ParkingPassLog $parkingPassLog)
    {
        $this->authorize('show', $parkingPassLog);

        return new ParkingPassLogResource($parkingPassLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ParkingPassLog $parkingPassLog
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ParkingPassLog $parkingPassLog)
    {
        $this->authorize('destroy', $parkingPassLog);

        $this->parkingPassLogRepository->delete($parkingPassLog);
        return response()->json(null, 204);
    }
}
