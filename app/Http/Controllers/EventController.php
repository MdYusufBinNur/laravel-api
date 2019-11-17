<?php

namespace App\Http\Controllers;

use App\DbModels\Event;
use App\Http\Requests\Event\IndexRequest;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventResourceCollection;
use App\Repositories\Contracts\EventRepository;

class EventController extends Controller
{
    /**
     * @var EventRepository
     */
    protected $eventRepository;

    /**
     * EventController constructor.
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Display a listing of the Event resource.
     *
     * @param IndexRequest $request
     * @return EventResourceCollection
     */
    public function index(IndexRequest $request)
    {
        if (strpos($request->getPathInfo(), 'property-login-page-events') !== false) {
            $request->merge(['allowedLoginPage' => 1]);
        }

        $events = $this->eventRepository->findBy($request->all());

        return new EventResourceCollection($events);
    }

    /**
     * Store a newly created Event resource in storage.
     *
     * @param  StoreRequest  $request
     * @return EventResource
     */
    public function store(StoreRequest $request)
    {
        $event = $this->eventRepository->save($request->all());

        return new EventResource($event);
    }

    /**
     * Display the specified Event resource.
     *
     * @param Event $event
     * @return EventResource
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update the specified Event resource in storage.
     *
     * @param UpdateRequest $request
     * @param Event $event
     * @return EventResource
     */
    public function update(UpdateRequest $request, Event $event)
    {
        $event = $this->eventRepository->update($event, $request->all());

        return new EventResource($event);
    }

    /**
     * Remove the specified Event resource from storage.
     *
     * @param Event $event
     * @return void
     */
    public function destroy(Event $event)
    {
        $this->eventRepository->delete($event);

        return response()->json(null, 204);
    }
}
