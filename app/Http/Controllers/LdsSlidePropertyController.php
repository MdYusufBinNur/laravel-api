<?php

namespace App\Http\Controllers;

use App\DbModels\LdsSlideProperty;
use App\Http\Requests\LdsSlideProperty\IndexRequest;
use App\Http\Requests\LdsSlideProperty\StoreRequest;
use App\Http\Requests\LdsSlideProperty\UpdateRequest;
use App\Http\Resources\LdsSlidePropertyResourceCollection;
use App\Http\Resources\LdsSlidePropertyResource;
use App\Repositories\Contracts\LdsSlidePropertyRepository;

class LdsSlidePropertyController extends Controller
{
    /**
     * @var LdsSlideProperty
     */
    protected $ldsSlidePropertyRepository;

    /**
     * LdsSlidePropertyController constructor.
     * @param LdsSlidePropertyRepository $ldsSlidePropertyRepository
     */
    public function __construct(LdsSlidePropertyRepository $ldsSlidePropertyRepository)
    {
        $this->ldsSlidePropertyRepository = $ldsSlidePropertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return LdsSlidePropertyResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $ldsSlideProperties = $this->ldsSlidePropertyRepository->findBy($request->all());

        return new LdsSlidePropertyResourceCollection($ldsSlideProperties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return LdsSlidePropertyResource
     */
    public function store(StoreRequest $request)
    {
        $ldsSlideProperty = $this->ldsSlidePropertyRepository->save($request->all());

        return new LdsSlidePropertyResource($ldsSlideProperty);
    }

    /**
     * Display the specified resource.
     *
     * @param LdsSlideProperty $ldsSlideProperty
     * @return LdsSlidePropertyResource
     */
    public function show(LdsSlideProperty $ldsSlideProperty)
    {
        return new LdsSlidePropertyResource($ldsSlideProperty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param LdsSlideProperty $ldsSlideProperty
     * @return LdsSlidePropertyResource
     */
    public function update(UpdateRequest $request, LdsSlideProperty $ldsSlideProperty)
    {
        $ldsSlideProperty = $this->ldsSlidePropertyRepository->update($ldsSlideProperty, $request->all());

        return new LdsSlidePropertyResource($ldsSlideProperty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LdsSlideProperty $ldsSlideProperty
     * @return void
     */
    public function destroy(LdsSlideProperty $ldsSlideProperty)
    {
        $this->ldsSlidePropertyRepository->delete($ldsSlideProperty);

        return response()->json(null, 204);
    }
}
