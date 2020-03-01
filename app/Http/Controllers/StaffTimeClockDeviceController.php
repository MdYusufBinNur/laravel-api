<?php

namespace App\Http\Controllers;

use App\DbModels\StaffTimeClockDevice;
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
        $this->authorize('list', StaffTimeClockDevice::class);

        $staffTimeClockDevices = $this->staffTimeClockDeviceRepository->findBy($request->all());

        return new StaffTimeClockDeviceResourceCollection($staffTimeClockDevices);
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
        $this->authorize('store', StaffTimeClockDevice::class);

        $staffTimeClockDevice = $this->staffTimeClockDeviceRepository->save($request->all());

        return new StaffTimeClockDeviceResource($staffTimeClockDevice);
    }

    /**
     * Display the specified resource.
     *
     * @param StaffTimeClockDevice $staffTimeClockDevice
     * @return StaffTimeClockDeviceResource
     * @throws AuthorizationException
     */
    public function show(StaffTimeClockDevice $staffTimeClockDevice)
    {
        $this->authorize('show', $staffTimeClockDevice);

        return new StaffTimeClockDeviceResource($staffTimeClockDevice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param StaffTimeClockDevice $staffTimeClockDevice
     * @return StaffTimeClockDeviceResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, StaffTimeClockDevice $staffTimeClockDevice)
    {
        $this->authorize('update', $staffTimeClockDevice);

        $staffTimeClockDevice = $this->staffTimeClockDeviceRepository->update($staffTimeClockDevice, $request->all());

        return new StaffTimeClockDeviceResource($staffTimeClockDevice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StaffTimeClockDevice $staffTimeClockDevice
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(StaffTimeClockDevice $staffTimeClockDevice)
    {
        $this->authorize('destroy', $staffTimeClockDevice);

        $this->staffTimeClockDeviceRepository->delete($staffTimeClockDevice);

        return response()->json(null, 204);
    }
}
