<?php

namespace App\Http\Controllers;

use App\DbModels\StaffTimeClock;
use App\Http\Requests\StaffTimeClock\IndexRequest;
use App\Http\Requests\StaffTimeClock\StoreRequest;
use App\Http\Requests\StaffTimeClock\UpdateRequest;
use App\Http\Resources\StaffTimeClockResource;
use App\Http\Resources\StaffTimeClockResourceCollection;
use App\Repositories\Contracts\StaffTimeClockRepository;

class StaffTimeClockController extends Controller
{
    /**
     * @var StaffTimeClockRepository
     */
    protected $staffTimeClockRepository;

    /**
     * StaffTimeClockController constructor.
     * @param StaffTimeClockRepository $staffTimeClockRepository
     */
    public function __construct(StaffTimeClockRepository $staffTimeClockRepository)
    {
        $this->staffTimeClockRepository = $staffTimeClockRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return StaffTimeClockResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $staffTimeClocks = $this->staffTimeClockRepository->findBy($request->all());

        return new StaffTimeClockResourceCollection($staffTimeClocks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return StaffTimeClockResource
     */
    public function store(StoreRequest $request)
    {
        $staffTimeClock = $this->staffTimeClockRepository->save($request->all());

        return new StaffTimeClockResource($staffTimeClock);
    }

    /**
     * Display the specified resource.
     *
     * @param StaffTimeClock $staffTimeClock
     * @return StaffTimeClockResource
     */
    public function show(StaffTimeClock $staffTimeClock)
    {
        return new StaffTimeClockResource($staffTimeClock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param StaffTimeClock $staffTimeClock
     * @return StaffTimeClockResource
     */
    public function update(UpdateRequest $request, StaffTimeClock $staffTimeClock)
    {
        $staffTimeClock = $this->staffTimeClockRepository->update($staffTimeClock, $request->all());

        return new StaffTimeClockResource($staffTimeClock);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StaffTimeClock $staffTimeClock
     * @return void
     */
    public function destroy(StaffTimeClock $staffTimeClock)
    {
        $this->staffTimeClockRepository->delete($staffTimeClock);

        return response()->json(null, 204);
    }
}
