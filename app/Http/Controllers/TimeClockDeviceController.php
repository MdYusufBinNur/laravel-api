<?php

namespace App\Http\Controllers;

use App\DbModels\TimeClockDevice;
use App\Http\Requests\TimeClockDevice\IndexRequest;
use App\Http\Requests\TimeClockDevice\StoreRequest;
use App\Http\Requests\TimeClockDevice\UpdateRequest;
use App\Http\Resources\TimeClockDeviceResource;
use App\Http\Resources\TimeClockDeviceResourceCollection;
use App\Repositories\Contracts\TimeClockDeviceRepository;
use Illuminate\Auth\Access\AuthorizationException;

class TimeClockDeviceController extends Controller
{
    /**
     * @var TimeClockDeviceRepository
     */
    protected $timeClockDeviceRepository;

    /**
     * TimeClockDeviceController constructor.
     * @param TimeClockDeviceRepository $timeClockDeviceRepository
     */
    public function __construct(TimeClockDeviceRepository $timeClockDeviceRepository)
    {
        $this->timeClockDeviceRepository = $timeClockDeviceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return TimeClockDeviceResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', TimeClockDevice::class);

        $timeClockDevices = $this->timeClockDeviceRepository->findBy($request->all());

        return new TimeClockDeviceResourceCollection($timeClockDevices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TimeClockDeviceResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', TimeClockDevice::class);

        $timeClockDevice = $this->timeClockDeviceRepository->save($request->all());

        return new TimeClockDeviceResource($timeClockDevice);
    }

    /**
     * Display the specified resource.
     *
     * @param TimeClockDevice $timeClockDevice
     * @return TimeClockDeviceResource
     * @throws AuthorizationException
     */
    public function show(TimeClockDevice $timeClockDevice)
    {
        $this->authorize('show', $timeClockDevice);

        return new TimeClockDeviceResource($timeClockDevice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param TimeClockDevice $timeClockDevice
     * @return TimeClockDeviceResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, TimeClockDevice $timeClockDevice)
    {
        $this->authorize('update', $timeClockDevice);

        $timeClockDevice = $this->timeClockDeviceRepository->update($timeClockDevice, $request->all());

        return new TimeClockDeviceResource($timeClockDevice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TimeClockDevice $timeClockDevice
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(TimeClockDevice $timeClockDevice)
    {
        $this->authorize('destroy', $timeClockDevice);

        $this->timeClockDeviceRepository->delete($timeClockDevice);

        return response()->json(null, 204);
    }
}
