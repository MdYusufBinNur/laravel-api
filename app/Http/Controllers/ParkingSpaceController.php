<?php

namespace App\Http\Controllers;

use App\DbModels\ParkingSpace;
use App\Http\Requests\ParkingSpace\IndexRequest;
use App\Http\Requests\ParkingSpace\StoreRequest;
use App\Http\Requests\ParkingSpace\UpdateRequest;
use App\Http\Resources\ParkingSpaceResource;
use App\Http\Resources\ParkingSpaceResourceCollection;
use App\Repositories\Contracts\ParkingSpaceRepository;

class ParkingSpaceController extends Controller
{
    /**
     * @var ParkingSpaceRepository
     */
    protected $parkingSpaceRepository;

    /**
     * ParkingSpaceController constructor.
     * @param ParkingSpaceRepository $parkingSpaceRepository
     */
    public function __construct(ParkingSpaceRepository $parkingSpaceRepository)
    {
        $this->parkingSpaceRepository = $parkingSpaceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ParkingSpaceResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $parkingSpaces = $this->parkingSpaceRepository->findBy($request->all());

        return new ParkingSpaceResourceCollection($parkingSpaces);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ParkingSpaceResource
     */
    public function store(StoreRequest $request)
    {
        $parkingSpace = $this->parkingSpaceRepository->save($request->all());

        return new ParkingSpaceResource($parkingSpace);
    }

    /**
     * Display the specified resource.
     *
     * @param ParkingSpace $parkingSpace
     * @return ParkingSpaceResource
     */
    public function show(ParkingSpace $parkingSpace)
    {
        return new ParkingSpaceResource($parkingSpace);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ParkingSpace $parkingSpace
     * @return ParkingSpaceResource
     */
    public function update(UpdateRequest $request, ParkingSpace $parkingSpace)
    {
        $parkingSpace = $this->parkingSpaceRepository->update($parkingSpace, $request->all());

        return new ParkingSpaceResource($parkingSpace);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ParkingSpace $parkingSpace
     * @return void
     */
    public function destroy(ParkingSpace $parkingSpace)
    {
        $this->parkingSpaceRepository->delete($parkingSpace);

        return response()->json(null, 204);
    }
}
