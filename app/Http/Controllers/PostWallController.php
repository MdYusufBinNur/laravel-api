<?php

namespace App\Http\Controllers;

use App\DbModels\PostWall;
use App\Http\Requests\PostWall\IndexRequest;
use App\Http\Requests\PostWall\StoreRequest;
use App\Http\Requests\PostWall\UpdateRequest;
use App\Http\Resources\PostWallResource;
use App\Http\Resources\PostWallResourceCollection;
use App\Repositories\Contracts\PostWallRepository;

class PostWallController extends Controller
{
    /**
     * @var PostWallRepository
     */
    protected $postWallRepository;

    /**
     * PostWallController constructor.
     * @param PostWallRepository $postWallRepository
     */
    public function __construct(PostWallRepository $postWallRepository)
    {
        $this->postWallRepository = $postWallRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostWallResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $postWalls = $this->postWallRepository->findBy($request->all());

        return new PostWallResourceCollection($postWalls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return PostWallResource
     */
    public function store(StoreRequest $request)
    {
        $postWall = $this->postWallRepository->save($request->all());

        return new PostWallResource($postWall);
    }

    /**
     * Display the specified resource.
     *
     * @param PostWall $postWall
     * @return PostWallResource
     */
    public function show(PostWall $postWall)
    {
        return new PostWallResource($postWall);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostWall $postWall
     * @return PostWallResource
     */
    public function update(UpdateRequest $request, PostWall $postWall)
    {
        $postWall = $this->postWallRepository->update($postWall,$request->all());

        return new PostWallResource($postWall);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostWall $postWall
     * @return void
     */
    public function destroy(PostWall $postWall)
    {
        $this->postWallRepository->delete($postWall);

        return response()->json(null,204);
    }
}