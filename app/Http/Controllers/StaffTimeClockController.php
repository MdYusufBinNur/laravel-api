<?php

namespace App\Http\Controllers;

use App\DbModels\StaffTimeClock;
use App\Http\Requests\StaffTimeClock\IndexRequest;
use App\Http\Requests\StaffTimeClock\StoreRequest;
use App\Http\Requests\StaffTimeClock\UpdateRequest;
use App\Http\Resources\StaffTimeClockResource;
use App\Http\Resources\StaffTimeClockResourceCollection;
use App\Repositories\Contracts\StaffTimeClockRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [StaffTimeClock::class, $request->input('propertyId')]);

        $staffTimeClocks = $this->staffTimeClockRepository->findBy($request->all());

        return new StaffTimeClockResourceCollection($staffTimeClocks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return StaffTimeClockResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [StaffTimeClock::class, $request->input('propertyId'), $request->input('propertyId')]);

        $staffTimeClock = $this->staffTimeClockRepository->save($request->all());

        return new StaffTimeClockResource($staffTimeClock);
    }

    /**
     * Display the specified resource.
     *
     * @param StaffTimeClock $staffTimeClock
     * @return StaffTimeClockResource
     * @throws AuthorizationException
     */
    public function show(StaffTimeClock $staffTimeClock)
    {
        $this->authorize('show', $staffTimeClock);

        return new StaffTimeClockResource($staffTimeClock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param StaffTimeClock $staffTimeClock
     * @return StaffTimeClockResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, StaffTimeClock $staffTimeClock)
    {
        $this->authorize('update', $staffTimeClock);

        $staffTimeClock = $this->staffTimeClockRepository->update($staffTimeClock, $request->all());

        return new StaffTimeClockResource($staffTimeClock);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StaffTimeClock $staffTimeClock
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(StaffTimeClock $staffTimeClock)
    {
        $this->authorize('destroy', $staffTimeClock);

        $this->staffTimeClockRepository->delete($staffTimeClock);

        return response()->json(null, 204);
    }
}
