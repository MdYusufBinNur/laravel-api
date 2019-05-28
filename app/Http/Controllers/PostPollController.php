<?php

namespace App\Http\Controllers;

use App\DbModels\PostPoll;
use App\Http\Requests\PostPoll\IndexRequest;
use App\Http\Requests\PostPoll\StoreRequest;
use App\Http\Requests\PostPoll\UpdateRequest;
use App\Http\Resources\PostPollResource;
use App\Http\Resources\PostPollResourceCollection;
use App\Repositories\Contracts\PostPollRepository;

class PostPollController extends Controller
{
    /**
     * @var PostPollRepository
     */
    protected $postPollRepository;

    /**
     * PostPollController constructor.
     * @param PostPollRepository $pollRepository
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
     */
    public function index(IndexRequest $request)
    {
        $postPolls = $this->postPollRepository->findBy($request->all());

        return new PostPollResourceCollection($postPolls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PostPollResource
     */
    public function store(StoreRequest $request)
    {
        $postPoll = $this->postPollRepository->save($request->all());

        return new PostPollResource($postPoll);
    }

    /**
     * Display the specified resource.
     *
     * @param PostPoll $postPoll
     * @return PostPollResource
     */
    public function show(PostPoll $postPoll)
    {
        return new PostPollResource($postPoll);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostPoll $postPoll
     * @return PostPollResource
     */
    public function update(UpdateRequest $request, PostPoll $postPoll)
    {
        $postPoll = $this->postPollRepository->update($postPoll, $request->all());

        return new PostPollResource($postPoll);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostPoll $postPoll
     * @return void
     */
    public function destroy(PostPoll $postPoll)
    {
        $this->postPollRepository->delete($postPoll);

        return response()->json(null,204);
    }
}
