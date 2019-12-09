<?php

namespace App\Http\Controllers;

use App\DbModels\LdsSlide;
use App\Http\Requests\LdsSlide\IndexRequest;
use App\Http\Requests\LdsSlide\StoreRequest;
use App\Http\Requests\LdsSlide\UpdateRequest;
use App\Http\Resources\LdsSlideResource;
use App\Http\Resources\LdsSlideResourceCollection;
use App\Repositories\Contracts\LdsSlideRepository;
use Illuminate\Auth\Access\AuthorizationException;

class LdsSlideController extends Controller
{
    /**
     * @var LdsSlideRepository
     */
    protected $ldsSlideRepository;

    /**
     * LdsSlideController constructor.
     * @param LdsSlideRepository $ldsSlideRepository
     */
    public function __construct(LdsSlideRepository $ldsSlideRepository)
    {
        $this->ldsSlideRepository = $ldsSlideRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return LdsSlideResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', LdsSlide::class);

        $ldsSlides = $this->ldsSlideRepository->findBy($request->all());

        return new LdsSlideResourceCollection($ldsSlides);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return LdsSlideResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', LdsSlide::class);

        $ldsSlide = $this->ldsSlideRepository->save($request->all());

        return new LdsSlideResource($ldsSlide);
    }

    /**
     * Display the specified resource.
     *
     * @param LdsSlide $ldsSlide
     * @return LdsSlideResource
     * @throws AuthorizationException
     */
    public function show(LdsSlide $ldsSlide)
    {
        $this->authorize('show', $ldsSlide);

        return new LdsSlideResource($ldsSlide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param LdsSlide $ldsSlide
     * @return LdsSlideResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, LdsSlide $ldsSlide)
    {
        $this->authorize('update', $ldsSlide);

        $ldsSlide = $this->ldsSlideRepository->update($ldsSlide, $request->all());

        return new LdsSlideResource($ldsSlide);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LdsSlide $ldsSlide
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(LdsSlide $ldsSlide)
    {
        $this->authorize('destroy', $ldsSlide);

        $this->ldsSlideRepository->delete($ldsSlide);

        return response()->json(null, 204);
    }
}
