<?php

namespace App\Http\Controllers;

use App\DbModels\ManagerTimeClockDevice;
use App\Http\Requests\ManagerTimeClockDevice\IndexRequest;
use App\Http\Requests\ManagerTimeClockDevice\StoreRequest;
use App\Http\Requests\ManagerTimeClockDevice\UpdateRequest;
use App\Http\Resources\ManagerTimeClockDeviceResource;
use App\Http\Resources\ManagerTimeClockDeviceResourceCollection;
use App\Repositories\Contracts\ManagerTimeClockDeviceRepository;

class ManagerTimeClockDeviceController extends Controller
{
    /**
     * @var ManagerTimeClockDeviceRepository
     */
    protected $managerTimeClockDeviceRepository;

    /**
     * ManagerTimeClockDeviceController constructor.
     * @param ManagerTimeClockDeviceRepository $managerTimeClockDeviceRepository
     */
    public function __construct(ManagerTimeClockDeviceRepository $managerTimeClockDeviceRepository)
    {
        $this->managerTimeClockDeviceRepository = $managerTimeClockDeviceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ManagerTimeClockDeviceResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $managerTimeClockDevices = $this->managerTimeClockDeviceRepository->findBy($request->all());

        return new ManagerTimeClockDeviceResourceCollection($managerTimeClockDevices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ManagerTimeClockDeviceResource
     */
    public function store(StoreRequest $request)
    {
        $managerTimeClockDevice = $this->managerTimeClockDeviceRepository->save($request->all());

        return new ManagerTimeClockDeviceResource($managerTimeClockDevice);
    }

    /**
     * Display the specified resource.
     *
     * @param ManagerTimeClockDevice $managerTimeClockDevice
     * @return ManagerTimeClockDeviceResource
     */
    public function show(ManagerTimeClockDevice $managerTimeClockDevice)
    {
        return new ManagerTimeClockDeviceResource($managerTimeClockDevice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ManagerTimeClockDevice $managerTimeClockDevice
     * @return ManagerTimeClockDeviceResource
     */
    public function update(UpdateRequest $request, ManagerTimeClockDevice $managerTimeClockDevice)
    {
        $managerTimeClockDevice = $this->managerTimeClockDeviceRepository->update($managerTimeClockDevice, $request->all());

        return new ManagerTimeClockDeviceResource($managerTimeClockDevice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManagerTimeClockDevice $managerTimeClockDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManagerTimeClockDevice $managerTimeClockDevice)
    {
        $this->managerTimeClockDeviceRepository->delete($managerTimeClockDevice);

        return response()->json(null, 204);
    }
}
