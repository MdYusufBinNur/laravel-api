<?php

namespace App\Http\Controllers;

use App\DbModels\Event;
use App\DbModels\EventSignup;
use App\Http\Requests\EventSignup\IndexRequest;
use App\Http\Requests\EventSignup\StoreRequest;
use App\Http\Requests\EventSignup\UpdateRequest;
use App\Http\Resources\EventSignupResource;
use App\Http\Resources\EventSignupResourceCollection;
use App\Repositories\Contracts\EventSignupRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [EventSignup::class, $request->get('propertyId')]);

        $eventSignups = $this->eventSignupRepository->findBy($request->all());

        return new EventSignupResourceCollection($eventSignups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return EventSignupResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [EventSignup::class, $request->get('eventId')]);

        $eventSignup = $this->eventSignupRepository->saveEventSignup($request->all());

        return new EventSignupResource($eventSignup);
    }

    /**
     * Display the specified EventSignup resource.
     *
     * @param EventSignup $eventSignup
     * @return EventSignupResource
     * @throws AuthorizationException
     */
    public function show(EventSignup $eventSignup)
    {
        $this->authorize('show', $eventSignup);

        return new EventSignupResource($eventSignup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param EventSignup $eventSignup
     * @return EventSignupResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, EventSignup $eventSignup)
    {
        $this->authorize('update', $eventSignup);

        $eventSignup = $this->eventSignupRepository->update($eventSignup, $request->all());

        return new EventSignupResource($eventSignup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EventSignup $eventSignup
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(EventSignup $eventSignup)
    {
        $this->authorize('destroy', $eventSignup);

        $this->eventSignupRepository->delete($eventSignup);

        return response()->json(null, 204);
    }
}
