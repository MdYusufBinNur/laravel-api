<?php

namespace App\Http\Controllers;

use App\DbModels\ManagerTimeClockDevice;
use App\Http\Requests\StaffTimeClockDevice\IndexRequest;
use App\Http\Requests\StaffTimeClockDevice\StoreRequest;
use App\Http\Requests\StaffTimeClockDevice\UpdateRequest;
use App\Http\Resources\StaffTimeClockDeviceResource;
use App\Http\Resources\StaffTimeClockDeviceResourceCollection;
use App\Repositories\Contracts\StaffTimeClockDeviceRepository;
use Illuminate\Auth\Access\AuthorizationException;

class StaffTimeClockDeviceController extends Controller
{
    /**
     * @var StaffTimeClockDeviceRepository
     */
    protected $staffTimeClockDeviceRepository;

    /**
     * StaffTimeClockDeviceController constructor.
     * @param StaffTimeClockDeviceRepository $staffTimeClockDeviceRepository
     */
    public function __construct(StaffTimeClockDeviceRepository $staffTimeClockDeviceRepository)
    {
        $this->staffTimeClockDeviceRepository = $staffTimeClockDeviceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return StaffTimeClockDeviceResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', ManagerTimeClockDevice::class);

        $managerTimeClockDevices = $this->staffTimeClockDeviceRepository->findBy($request->all());

        return new StaffTimeClockDeviceResourceCollection($managerTimeClockDevices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return StaffTimeClockDeviceResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', ManagerTimeClockDevice::class);

        $managerTimeClockDevice = $this->staffTimeClockDeviceRepository->save($request->all());

        return new StaffTimeClockDeviceResource($managerTimeClockDevice);
    }

    /**
     * Display the specified resource.
     *
     * @param ManagerTimeClockDevice $managerTimeClockDevice
     * @return StaffTimeClockDeviceResource
     * @throws AuthorizationException
     */
    public function show(ManagerTimeClockDevice $managerTimeClockDevice)
    {
        $this->authorize('show', $managerTimeClockDevice);

        return new StaffTimeClockDeviceResource($managerTimeClockDevice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ManagerTimeClockDevice $managerTimeClockDevice
     * @return StaffTimeClockDeviceResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ManagerTimeClockDevice $managerTimeClockDevice)
    {
        $this->authorize('update', $managerTimeClockDevice);

        $managerTimeClockDevice = $this->staffTimeClockDeviceRepository->update($managerTimeClockDevice, $request->all());

        return new StaffTimeClockDeviceResource($managerTimeClockDevice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManagerTimeClockDevice $managerTimeClockDevice
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(ManagerTimeClockDevice $managerTimeClockDevice)
    {
        $this->authorize('destroy', $managerTimeClockDevice);

        $this->staffTimeClockDeviceRepository->delete($managerTimeClockDevice);

        return response()->json(null, 204);
    }
}
