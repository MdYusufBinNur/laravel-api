<?php

namespace App\Http\Controllers;

use App\DbModels\PostPoll;
use App\Http\Requests\PostPoll\IndexRequest;
use App\Http\Requests\PostPoll\StoreRequest;
use App\Http\Requests\PostPoll\UpdateRequest;
use App\Http\Resources\PostPollResource;
use App\Http\Resources\PostPollResourceCollection;
use App\Repositories\Contracts\PostPollRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PostPollController extends Controller
{
    /**
     * @var PostPollRepository
     */
    protected $postPollRepository;

    /**
     * PostPollController constructor.
     * @param PostPollRepository $postPollRepository
     */
    public function __construct(PostPollRepository $postPollRepository)
    {
        $this->postPollRepository = $postPollRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostPollResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PostPoll::class, $request->input('propertyId')]);

        $postPolls = $this->postPollRepository->findBy($request->all());

        return new PostPollResourceCollection($postPolls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PostPollResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PostPoll::class, $request->get('post')['propertyId']]);

        $postPoll = $this->postPollRepository->save($request->all());

        return new PostPollResource($postPoll);
    }

    /**
     * Display the specified resource.
     *
     * @param PostPoll $postPoll
     * @return PostPollResource
     * @throws AuthorizationException
     */
    public function show(PostPoll $postPoll)
    {
        $this->authorize('show', $postPoll);

        return new PostPollResource($postPoll);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostPoll $postPoll
     * @return PostPollResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PostPoll $postPoll)
    {
        $this->authorize('update', $postPoll);

        $postPoll = $this->postPollRepository->update($postPoll, $request->all());

        return new PostPollResource($postPoll);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostPoll $postPoll
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PostPoll $postPoll)
    {
        $this->authorize('destroy', $postPoll);

        $this->postPollRepository->delete($postPoll);

        return response()->json(null,204);
    }
}
