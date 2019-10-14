<?php

namespace App\Http\Controllers;

use App\DbModels\ParkingPassLog;
use App\Http\Requests\ParkingPassLog\StoreRequest;
use App\Http\Requests\ParkingPassLog\IndexRequest;
use App\Http\Resources\ParkingPassLogResource;
use App\Http\Resources\ParkingPassLogResourceCollection;
use App\Repositories\Contracts\ParkingPassLogRepository;

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
     */
    public function index(IndexRequest $request)
    {
        $parkingPassLogs = $this->parkingPassLogRepository->findBy($request->all());

        return new ParkingPassLogResourceCollection($parkingPassLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ParkingPassLogResource
     */
    public function store(StoreRequest $request)
    {
        $parkingPassLog = $this->parkingPassLogRepository->save($request->all());

        return new ParkingPassLogResource($parkingPassLog);
    }

    /**
     * Display the specified resource.
     *
     * @param ParkingPassLog $parkingPassLog
     * @return ParkingPassLogResource
     */
    public function show(ParkingPassLog $parkingPassLog)
    {
        return new ParkingPassLogResource($parkingPassLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ParkingPassLog $parkingPassLog
     * @return void
     */
    public function destroy(ParkingPassLog $parkingPassLog)
    {
        $this->parkingPassLogRepository->delete($parkingPassLog);
        return response()->json(null, 204);
    }
}
