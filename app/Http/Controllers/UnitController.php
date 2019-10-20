<?php

namespace App\Http\Controllers;

use App\DbModels\Unit;
use App\Http\Requests\Unit\FloorListAutoCompleteRequest;
use App\Http\Requests\Unit\IndexRequest;
use App\Http\Requests\Unit\LineListAutoCompleteRequest;
use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Http\Resources\FloorListAutoCompleteResourceCollection;
use App\Http\Resources\LineListAutoCompleteResourceCollection;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UnitResourceCollection;
use App\Repositories\Contracts\UnitRepository;

class UnitController extends Controller
{
    /**
     * @var UnitRepository
     */
    protected $unitRepository;

    /**
     * UnitController constructor.
     * @param UnitRepository $unitRepository
     */
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * Display a listing of the Unit resource.
     *
     * @param IndexRequest $request
     * @return UnitResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $units = $this->unitRepository->findBy($request->all());

        return new UnitResourceCollection($units);
    }

    /**
     * Store a newly created Unit resource in storage.
     *
     * @param  StoreRequest  $request
     * @return UnitResource
     */
    public function store(StoreRequest $request)
    {
        $unit = $this->unitRepository->save($request->all());

        return new UnitResource($unit);
    }

    /**
     * Display the specified Unit resource.
     *
     * @param Unit $unit
     * @return UnitResource
     */
    public function show(Unit $unit)
    {
        return new UnitResource($unit);
    }

    /**
     * Update the specified Unit resource in storage.
     *
     * @param UpdateRequest $request
     * @param Unit $unit
     * @return UnitResource
     */
    public function update(UpdateRequest $request, Unit $unit)
    {
        $unit = $this->unitRepository->update($unit, $request->all());

        return new UnitResource($unit);
    }

    /**
     * Remove the specified Unit resource from storage.
     *
     * @param Unit $unit
     * @return void
     */
    public function destroy(Unit $unit)
    {
        $this->unitRepository->delete($unit);

        return response()->json(null, 204);
    }

    /**
     * get auto-complete list of lines
     *
     * @param FloorListAutoCompleteRequest $request
     * @return FloorListAutoCompleteResourceCollection
     */
    public function floorListAutoComplete(FloorListAutoCompleteRequest $request)
    {
        $units = $this->unitRepository->floorListAutoComplete($request->all());
        return new FloorListAutoCompleteResourceCollection(collect($units));
    }

    /**
     * get auto-complete list of lines
     *
     * @param LineListAutoCompleteRequest $request
     * @return LineListAutoCompleteResourceCollection
     */
    public function lineListAutoComplete(LineListAutoCompleteRequest $request)
    {
        $units = $this->unitRepository->lineListAutoComplete($request->all());
        return new LineListAutoCompleteResourceCollection(collect($units));
    }
}
