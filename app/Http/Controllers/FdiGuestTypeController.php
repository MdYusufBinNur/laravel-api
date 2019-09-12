<?php

namespace App\Http\Controllers;

use App\DbModels\FdiGuestType;
use App\Http\Requests\FdiGuestType\IndexRequest;
use App\Http\Requests\FdiGuestType\StoreRequest;
use App\Http\Requests\FdiGuestType\UpdateRequest;
use App\Http\Resources\FdiGuestTypeResource;
use App\Http\Resources\FdiGuestTypeResourceCollection;
use App\Repositories\Contracts\FdiGuestTypeRepository;

class FdiGuestTypeController extends Controller
{
    /**
     * @var FdiGuestTypeRepository
     */
    protected $fdiGuestTypeRepository;

    /**
     * FdiGuestTypeController constructor.
     * @param FdiGuestTypeRepository $fdiGuestTypeRepository
     */
    public function __construct(FdiGuestTypeRepository $fdiGuestTypeRepository)
    {
        $this->fdiGuestTypeRepository = $fdiGuestTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return FdiGuestTypeResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $fdiGuestTypes = $this->fdiGuestTypeRepository->findBy($request->all());

        return new FdiGuestTypeResourceCollection($fdiGuestTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return FdiGuestTypeResource
     */
    public function store(StoreRequest $request)
    {
        $fdiGuestType = $this->fdiGuestTypeRepository->save($request->all());

        return new FdiGuestTypeResource($fdiGuestType);
    }

    /**
     * Display the specified resource.
     *
     * @param FdiGuestType $fdiGuestType
     * @return FdiGuestTypeResource
     */
    public function show(FdiGuestType $fdiGuestType)
    {
        return new FdiGuestTypeResource($fdiGuestType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param FdiGuestType $fdiGuestType
     * @return FdiGuestTypeResource
     */
    public function update(UpdateRequest $request, FdiGuestType $fdiGuestType)
    {
        $fdiGuestType = $this->fdiGuestTypeRepository->update($fdiGuestType, $request->all());

        return new FdiGuestTypeResource($fdiGuestType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FdiGuestType $fdiGuestType
     * @return void
     */
    public function destroy(FdiGuestType $fdiGuestType)
    {
        $this->fdiGuestTypeRepository->delete($fdiGuestType);

        return response()->json(null, 204);
    }
}
