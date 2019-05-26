<?php

namespace App\Http\Controllers;

use App\DbModels\NotificationFeed;
use App\Http\Requests\NotificationFeed\IndexRequest;
use App\Http\Requests\NotificationFeed\StoreRequest;
use App\Http\Requests\NotificationFeed\UpdateRequest;
use App\Http\Resources\NotificationFeedResource;
use App\Http\Resources\NotificationFeedResourceCollection;
use App\Repositories\Contracts\NotificationFeedRepository;
use http\Env\Response;
use Illuminate\Http\Request;

class NotificationFeedController extends Controller
{
    /**
     * @var NotificationFeedRepository
     */
    protected $notificationFeedRepository;

    /**
     * NotificationFeedController constructor.
     * @param NotificationFeedRepository $notificationFeedRepository
     */
    public function __construct(NotificationFeedRepository $notificationFeedRepository)
    {
        $this->notificationFeedRepository = $notificationFeedRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return NotificationFeedResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $notificationFeeds = $this->notificationFeedRepository->findBy($request->all());

        return new NotificationFeedResourceCollection($notificationFeeds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return NotificationFeedResource
     */
    public function store(StoreRequest $request)
    {
        $notificationFeed = $this->notificationFeedRepository->save($request->all());

        return new NotificationFeedResource($notificationFeed);
    }

    /**
     * Display the specified resource.
     *
     * @param NotificationFeed $notificationFeed
     * @return NotificationFeedResource
     */
    public function show(NotificationFeed $notificationFeed)
    {
        return new NotificationFeedResource($notificationFeed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param NotificationFeed $notificationFeed
     * @return NotificationFeedResource
     */
    public function update(UpdateRequest $request, NotificationFeed $notificationFeed)
    {
        $notificationFeed = $this->notificationFeedRepository->update($notificationFeed, $request->all());

        return new NotificationFeedResource($notificationFeed);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param NotificationFeed $notificationFeed
     * @return void
     */
    public function destroy(NotificationFeed $notificationFeed)
    {
        $this->notificationFeedRepository->delete($notificationFeed);

        return response()->json(null,204);
    }
}
