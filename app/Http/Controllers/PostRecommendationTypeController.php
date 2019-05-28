<?php

namespace App\Http\Controllers;

use App\DbModels\PostRecommendationType;
use App\Http\Requests\PostRecommendationType\IndexRequest;
use App\Http\Requests\PostRecommendationType\StoreRequest;
use App\Http\Requests\PostRecommendationType\UpdateRequest;
use App\Http\Resources\PostRecommendationTypeResource;
use App\Http\Resources\PostRecommendationTypeResourceCollection;
use App\Repositories\Contracts\PostRecommendationTypeRepository;

class PostRecommendationTypeController extends Controller
{
    /**
     * @var PostRecommendationTypeRepository
     */
    protected $postRecommendationTypeRepository;

    /**
     * PostRecommendationTypeController constructor.
     * @param PostRecommendationTypeRepository $postRecommendationTypeRepository
     */
    public function __construct(PostRecommendationTypeRepository $postRecommendationTypeRepository)
    {
        $this->postRecommendationTypeRepository = $postRecommendationTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostRecommendationTypeResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $postRecommendationTypes = $this->postRecommendationTypeRepository->findBy($request->all());

        return new PostRecommendationTypeResourceCollection($postRecommendationTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PostRecommendationTypeResource
     */
    public function store(StoreRequest $request)
    {
        $postRecommendationType = $this->postRecommendationTypeRepository->save($request->all());

        return new PostRecommendationTypeResource($postRecommendationType);
    }

    /**
     * Display the specified resource.
     *
     * @param PostRecommendationType $postRecommendationType
     * @return PostRecommendationTypeResource
     */
    public function show(PostRecommendationType $postRecommendationType)
    {
        return new PostRecommendationTypeResource($postRecommendationType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostRecommendationType $postRecommendationType
     * @return PostRecommendationTypeResource
     */
    public function update(UpdateRequest $request, PostRecommendationType $postRecommendationType)
    {
        $postRecommendationType = $this->postRecommendationTypeRepository->update($postRecommendationType,$request->all());

        return new PostRecommendationTypeResource($postRecommendationType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostRecommendationType $postRecommendationType
     * @return void
     */
    public function destroy(PostRecommendationType $postRecommendationType)
    {
        $this->postRecommendationTypeRepository->delete($postRecommendationType);

        return response()->json(null, 204);
    }
}
