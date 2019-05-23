<?php

namespace App\Http\Controllers;

use App\DbModels\EventSignup;
use App\Http\Requests\EventSignup\IndexRequest;
use App\Http\Requests\EventSignup\StoreRequest;
use App\Http\Requests\EventSignup\UpdateRequest;
use App\Http\Resources\EventSignupResource;
use App\Http\Resources\EventSignupResourceCollection;
use App\Repositories\Contracts\EventSignupRepository;
use Illuminate\Http\Request;

class EventSignupController extends Controller
{
    /**
     * @var EventSignupRepository
     */
    protected $eventSignupRepository;

    /**
     * EventSignupController constructor.
     * @param EventSignupRepository $eventSignupRepository
     */
    public function __construct(EventSignupRepository $eventSignupRepository)
    {
        $this->eventSignupRepository = $eventSignupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return EventSignupResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $eventSignups= $this->eventSignupRepository->findBy($request->all());

        return new EventSignupResourceCollection($eventSignups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return EventSignupResource
     */
    public function store(StoreRequest $request)
    {
        $eventSignup = $this->eventSignupRepository->save($request->all());

        return new EventSignupResource($eventSignup);
    }

    /**
     * Display the specified EventSignup resource.
     *
     * @param EventSignup $eventSignup
     * @return EventSignupResource
     */
    public function show(EventSignup $eventSignup)
    {
        return new EventSignupResource($eventSignup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param EventSignup $eventSignup
     * @return EventSignupResource
     */
    public function update(UpdateRequest $request, EventSignup $eventSignup)
    {
        $eventSignup = $this->eventSignupRepository->update($eventSignup, $request->all());

        return new EventSignupResource($eventSignup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EventSignup $eventSignup
     * @return void
     */
    public function destroy(EventSignup $eventSignup)
    {
        $this->eventSignupRepository->delete($eventSignup);

        return response()->json(null, 204);
    }
}
