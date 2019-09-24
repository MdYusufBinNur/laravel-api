<?php

namespace App\Http\Controllers;

use App\DbModels\LdsBlacklistUnit;
use App\Http\Requests\LdsBlacklistUnit\IndexRequest;
use App\Http\Requests\LdsBlacklistUnit\StoreRequest;
use App\Http\Requests\LdsBlacklistUnit\UpdateRequest;
use App\Http\Resources\LdsBlacklistUnitResource;
use App\Http\Resources\LdsBlacklistUnitResourceCollection;
use App\Repositories\Contracts\LdsBlacklistUnitRepository;

class LdsBlacklistUnitController extends Controller
{
    /**
     * @var LdsBlacklistUnitRepository
     */
    protected $ldsBlacklistUnitRepository;

    /**
     * LdsBlacklistUnitController constructor.
     * @param LdsBlacklistUnitRepository $ldsBlacklistUnitRepository
     */
    public function __construct(LdsBlacklistUnitRepository $ldsBlacklistUnitRepository)
    {
        $this->ldsBlacklistUnitRepository = $ldsBlacklistUnitRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return LdsBlacklistUnitResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $ldsBlackListUnits = $this->ldsBlacklistUnitRepository->findBy($request->all());

        return new LdsBlacklistUnitResourceCollection($ldsBlackListUnits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return LdsBlacklistUnitResource
     */
    public function store(StoreRequest $request)
    {
        $ldsBlacklistUnit = $this->ldsBlacklistUnitRepository->saveBlackListUnit($request->all());

        return new LdsBlacklistUnitResource($ldsBlacklistUnit);
    }

    /**
     * Display the specified resource.
     *
     * @param LdsBlacklistUnit $ldsBlacklistUnit
     * @return LdsBlacklistUnitResource
     */
    public function show(LdsBlacklistUnit $ldsBlacklistUnit)
    {
        return new LdsBlacklistUnitResource($ldsBlacklistUnit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param LdsBlacklistUnit $ldsBlacklistUnit
     * @return LdsBlacklistUnitResource
     */
    public function update(UpdateRequest $request, LdsBlacklistUnit $ldsBlacklistUnit)
    {
        $ldsBlacklistUnit = $this->ldsBlacklistUnitRepository->update($ldsBlacklistUnit, $request->all());

        return new LdsBlacklistUnitResource($ldsBlacklistUnit);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LdsBlacklistUnit $ldsBlacklistUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(LdsBlacklistUnit $ldsBlacklistUnit)
    {
        $this->ldsBlacklistUnitRepository->delete($ldsBlacklistUnit);

        return response()->json(null,204);
    }
}
