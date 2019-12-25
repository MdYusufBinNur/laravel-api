<?php

namespace App\Http\Controllers;

use App\DbModels\PostRecommendation;
use App\Http\Requests\PostRecommendation\IndexRequest;
use App\Http\Requests\PostRecommendation\StoreRequest;
use App\Http\Requests\PostRecommendation\UpdateRequest;
use App\Http\Resources\PostRecommendationResource;
use App\Http\Resources\PostRecommendationResourceCollection;
use App\Repositories\Contracts\PostRecommendationRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PostRecommendation::class, $request->get('propertyId')]);

        $postRecommendations = $this->postRecommendationRepository->findBy($request->all());

        return new PostRecommendationResourceCollection($postRecommendations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return PostRecommendationResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PostRecommendation::class, $request->get('post')['propertyId']]);

        $postRecommendation = $this->postRecommendationRepository->save($request->all());

        return new PostRecommendationResource($postRecommendation);
    }

    /**
     * Display the specified resource.
     *
     * @param PostRecommendation $postRecommendation
     * @return PostRecommendationResource
     * @throws AuthorizationException
     */
    public function show(PostRecommendation $postRecommendation)
    {
        $this->authorize('show', $postRecommendation);

        return new PostRecommendationResource($postRecommendation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostRecommendation $postRecommendation
     * @return PostRecommendationResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PostRecommendation $postRecommendation)
    {
        $this->authorize('update', $postRecommendation);

        $postRecommendation = $this->postRecommendationRepository->update($postRecommendation,$request->all());

        return new PostRecommendationResource($postRecommendation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostRecommendation $postRecommendation
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PostRecommendation $postRecommendation)
    {
        $this->authorize('destroy', $postRecommendation);

        $this->postRecommendationRepository->delete($postRecommendation);

        return response()->json(null,204);
    }
}
