<?php

namespace App\Http\Controllers;

use App\DbModels\LdsBlacklistUnit;
use App\Http\Requests\LdsBlacklistUnit\IndexRequest;
use App\Http\Requests\LdsBlacklistUnit\StoreRequest;
use App\Http\Requests\LdsBlacklistUnit\UpdateRequest;
use App\Http\Resources\LdsBlacklistUnitResource;
use App\Http\Resources\LdsBlacklistUnitResourceCollection;
use App\Repositories\Contracts\LdsBlacklistUnitRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [LdsBlacklistUnit::class, $request->input('propertyId')]);

        $ldsBlackListUnits = $this->ldsBlacklistUnitRepository->findBy($request->all());

        return new LdsBlacklistUnitResourceCollection($ldsBlackListUnits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return LdsBlacklistUnitResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [LdsBlacklistUnit::class, $request->input('propertyId')]);

        $ldsBlacklistUnit = $this->ldsBlacklistUnitRepository->saveBlackListUnit($request->all());

        return new LdsBlacklistUnitResource($ldsBlacklistUnit);
    }

    /**
     * Display the specified resource.
     *
     * @param LdsBlacklistUnit $ldsBlacklistUnit
     * @return LdsBlacklistUnitResource
     * @throws AuthorizationException
     */
    public function show(LdsBlacklistUnit $ldsBlacklistUnit)
    {
        $this->authorize('show', $ldsBlacklistUnit);

        return new LdsBlacklistUnitResource($ldsBlacklistUnit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param LdsBlacklistUnit $ldsBlacklistUnit
     * @return LdsBlacklistUnitResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, LdsBlacklistUnit $ldsBlacklistUnit)
    {
        $this->authorize('update', $ldsBlacklistUnit);

        $ldsBlacklistUnit = $this->ldsBlacklistUnitRepository->update($ldsBlacklistUnit, $request->all());

        return new LdsBlacklistUnitResource($ldsBlacklistUnit);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LdsBlacklistUnit $ldsBlacklistUnit
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(LdsBlacklistUnit $ldsBlacklistUnit)
    {
        $this->authorize('destroy', $ldsBlacklistUnit);

        $this->ldsBlacklistUnitRepository->delete($ldsBlacklistUnit);

        return response()->json(null,204);
    }
}
