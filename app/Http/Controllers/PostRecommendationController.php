<?php

namespace App\Http\Controllers;

use App\DbModels\PostRecommendation;
use App\Http\Requests\PostRecommendation\IndexRequest;
use App\Http\Requests\PostRecommendation\StoreRequest;
use App\Http\Requests\PostRecommendation\UpdateRequest;
use App\Http\Resources\PostRecommendationResource;
use App\Http\Resources\PostRecommendationResourceCollection;
use App\Repositories\Contracts\PostRecommendationRepository;

class PostRecommendationController extends Controller
{
    /**
     * @var PostRecommendationRepository
     */
    protected $postRecommendationRepository;

    /**
     * PostRecommendationController constructor.
     * @param PostRecommendationRepository $postRecommendationRepository
     */
    public function __construct(PostRecommendationRepository $postRecommendationRepository)
    {
        $this->postRecommendationRepository = $postRecommendationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostRecommendationResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $postRecommendations = $this->postRecommendationRepository->findBy($request->all());

        return new PostRecommendationResourceCollection($postRecommendations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return PostRecommendationResource
     */
    public function store(StoreRequest $request)
    {
        $postRecommendation = $this->postRecommendationRepository->save($request->all());

        return new PostRecommendationResource($postRecommendation);
    }

    /**
     * Display the specified resource.
     *
     * @param PostRecommendation $postRecommendation
     * @return PostRecommendationResource
     */
    public function show(PostRecommendation $postRecommendation)
    {
        return new PostRecommendationResource($postRecommendation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostRecommendation $postRecommendation
     * @return PostRecommendationResource
     */
    public function update(UpdateRequest $request, PostRecommendation $postRecommendation)
    {
        $postRecommendation = $this->postRecommendationRepository->update($postRecommendation,$request->all());

        return new PostRecommendationResource($postRecommendation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostRecommendation $postRecommendation
     * @return void
     */
    public function destroy(PostRecommendation $postRecommendation)
    {
        $this->postRecommendationRepository->delete($postRecommendation);

        return response()->json(null,204);
    }
}
