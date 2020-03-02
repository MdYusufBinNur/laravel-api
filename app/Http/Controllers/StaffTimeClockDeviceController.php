<?php

namespace App\Http\Controllers;

use App\DbModels\StaffTimeClockDevice;
use App\Http\Requests\StaffTimeClockDevice\IndexRequest;
use App\Http\Requests\StaffTimeClockDevice\StoreRequest;
use App\Http\Requests\StaffTimeClockDevice\UpdateRequest;
use App\Http\Resources\StaffTimeClockDeviceResource;
use App\Http\Resources\StaffTimeClockDeviceResourceCollection;
use App\Repositories\Contracts\StaffTimeClockDeviceRepository;

class StaffTimeClockDeviceController extends Controller
{

    /**
     * @var StaffTimeClockDeviceRepository
     */
    protected $staffTimeClockDeviceRepository;

    public function __construct(StaffTimeClockDeviceRepository $staffTimeClockDeviceRepository)
    {
        $this->staffTimeClockDeviceRepository = $staffTimeClockDeviceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return StaffTimeClockDeviceResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $staffTimeClockDevices = $this->staffTimeClockDeviceRepository->findBy($request->all());

        return new StaffTimeClockDeviceResourceCollection($staffTimeClockDevices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return StaffTimeClockDeviceResource
     */
    public function store(StoreRequest $request)
    {
        $staffTimeClockDevice = $this->staffTimeClockDeviceRepository->save($request->all());

        return new StaffTimeClockDeviceResource($staffTimeClockDevice);
    }

    /**
     * Display the specified resource.
     *
     * @param StaffTimeClockDevice $staffTimeClockDevice
     * @return StaffTimeClockDeviceResource
     */
    public function show(StaffTimeClockDevice $staffTimeClockDevice)
    {
        return new StaffTimeClockDeviceResource($staffTimeClockDevice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param StaffTimeClockDevice $staffTimeClockDevice
     * @return StaffTimeClockDeviceResource
     */
    public function update(UpdateRequest $request, StaffTimeClockDevice $staffTimeClockDevice)
    {
        $staffTimeClockDevice = $this->staffTimeClockDeviceRepository->update($staffTimeClockDevice, $request->all());

        return new StaffTimeClockDeviceResource($staffTimeClockDevice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StaffTimeClockDevice $staffTimeClockDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffTimeClockDevice $staffTimeClockDevice)
    {
        $this->staffTimeClockDeviceRepository->delete($staffTimeClockDevice);

        return response()->json(null, 204);
    }
}
