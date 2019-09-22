<?php

namespace App\Http\Controllers;

use App\DbModels\LdsSlide;
use App\Http\Requests\LdsSlide\IndexRequest;
use App\Http\Requests\LdsSlide\StoreRequest;
use App\Http\Requests\LdsSlide\UpdateRequest;
use App\Http\Resources\LdsSlideResource;
use App\Http\Resources\LdsSlideResourceCollection;
use App\Repositories\Contracts\LdsSlideRepository;

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
     */
    public function index(IndexRequest $request)
    {
        $ldsSlides = $this->ldsSlideRepository->findBy($request->all());

        return new LdsSlideResourceCollection($ldsSlides);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return LdsSlideResource
     */
    public function store(StoreRequest $request)
    {
        $ldsSlide = $this->ldsSlideRepository->save($request->all());

        return new LdsSlideResource($ldsSlide);
    }

    /**
     * Display the specified resource.
     *
     * @param LdsSlide $ldsSlide
     * @return LdsSlideResource
     */
    public function show(LdsSlide $ldsSlide)
    {
        return new LdsSlideResource($ldsSlide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param LdsSlide $ldsSlide
     * @return LdsSlideResource
     */
    public function update(UpdateRequest $request, LdsSlide $ldsSlide)
    {
        $ldsSlide = $this->ldsSlideRepository->update($ldsSlide, $request->all());

        return new LdsSlideResource($ldsSlide);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LdsSlide $ldsSlide
     * @return \Illuminate\Http\Response
     */
    public function destroy(LdsSlide $ldsSlide)
    {
        $this->ldsSlideRepository->delete($ldsSlide);

        return response()->json(null, 204);
    }
}
