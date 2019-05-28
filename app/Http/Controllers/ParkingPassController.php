<?php

namespace App\Http\Controllers;

use App\DbModels\ParkingPass;
use App\Http\Requests\ParkingPass\IndexRequest;
use App\Http\Requests\ParkingPass\StoreRequest;
use App\Http\Requests\ParkingPass\UpdateRequest;
use App\Http\Resources\ParkingPassResource;
use App\Http\Resources\ParkingPassResourceCollection;
use App\Repositories\Contracts\ParkingPassRepository;

class ParkingPassController extends Controller
{
    /**
     * @var ParkingPassRepository
     */
    protected $parkingPassRepository;

    /**
     * ParkingPassController constructor.
     * @param ParkingPassRepository $parkingPassRepository
     */
    public function __construct(ParkingPassRepository $parkingPassRepository)
    {
        $this->parkingPassRepository = $parkingPassRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ParkingPassResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $parkingPasses = $this->parkingPassRepository->findBy($request->all());

        return new ParkingPassResourceCollection($parkingPasses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return ParkingPassResource
     */
    public function store(StoreRequest $request)
    {
        $parkingPass = $this->parkingPassRepository->save($request->all());

        return new ParkingPassResource($parkingPass);
    }

    /**
     * Display the specified resource.
     *
     * @param ParkingPass $parkingPass
     * @return ParkingPassResource
     */
    public function show(ParkingPass $parkingPass)
    {
        return new ParkingPassResource($parkingPass);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ParkingPass $parkingPass
     * @return ParkingPassResource
     */
    public function update(UpdateRequest $request, ParkingPass $parkingPass)
    {
        $parkingPass = $this->parkingPassRepository->update($parkingPass, $request->all());

        return new ParkingPassResource($parkingPass);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ParkingPass $parkingPass
     * @return void
     */
    public function destroy(ParkingPass $parkingPass)
    {
        $this->parkingPassRepository->delete($parkingPass);

        return response()->json(null,204);
    }
}
