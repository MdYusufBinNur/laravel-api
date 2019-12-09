<?php

namespace App\Http\Controllers;

use App\DbModels\PostEvent;
use App\Http\Requests\PostEvent\IndexRequest;
use App\Http\Requests\PostEvent\StoreRequest;
use App\Http\Requests\PostEvent\UpdateRequest;
use App\Http\Resources\PostEventResource;
use App\Http\Resources\PostEventResourceCollection;
use App\Repositories\Contracts\PostEventRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PostEventController extends Controller
{
    /**
     * @var PostEventRepository
     */
    protected $postEventRepository;

    /**
     * PostEventController constructor.
     * @param PostEventRepository $postEventRepository
     */
    public function __construct(PostEventRepository $postEventRepository)
    {
        $this->postEventRepository = $postEventRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostEventResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PostEvent::class, $request->get('propertyId')]);

        $postEvents = $this->postEventRepository->findBy($request->all());

        return new PostEventResourceCollection($postEvents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return PostEventResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PostEvent::class, $request->get('propertyId')]);

        $postEvent = $this->postEventRepository->save($request->all());

        return new PostEventResource($postEvent);
    }

    /**
     * Display the specified resource.
     *
     * @param PostEvent $postEvent
     * @return PostEventResource
     * @throws AuthorizationException
     */
    public function show(PostEvent $postEvent)
    {
        $this->authorize('show', $postEvent);

        return new PostEventResource($postEvent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostEvent $postEvent
     * @return PostEventResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PostEvent $postEvent)
    {
        $this->authorize('update', $postEvent);

        $postEvent = $this->postEventRepository->update($postEvent, $request->all());

        return new PostEventResource($postEvent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostEvent $postEvent
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PostEvent $postEvent)
    {
        $this->authorize('destroy', $postEvent);

        $this->postEventRepository->delete($postEvent);

        return response()->json(null, 204);
    }
}
