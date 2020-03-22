<?php

namespace App\Http\Controllers;

use App\DbModels\CommitteeType;
use App\Http\Requests\CommitteeType\IndexRequest;
use App\Http\Requests\CommitteeType\StoreRequest;
use App\Http\Requests\CommitteeType\UpdateRequest;
use App\Http\Resources\CommitteeTypeResource;
use App\Http\Resources\CommitteeTypeResourceCollection;
use App\Repositories\Contracts\CommitteeTypeRepository;
use Illuminate\Auth\Access\AuthorizationException;

class CommitteeTypeController extends Controller
{
    /**
     * @var CommitteeTypeRepository
     */
    protected $committeeTypeRepository;

    /**
     * CommitteeTypeController constructor.
     * @param CommitteeTypeRepository $committeeTypeRepository
     */
    public  function __construct(CommitteeTypeRepository $committeeTypeRepository)
    {
        $this->committeeTypeRepository = $committeeTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CommitteeTypeResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [CommitteeType::class, $request->input('propertyId')]);

        $committeeTypes = $this->committeeTypeRepository->findBy($request->all());

        return new CommitteeTypeResourceCollection($committeeTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return CommitteeTypeResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [CommitteeType::class, $request->input('propertyId')]);

        $committeeType = $this->committeeTypeRepository->save($request->all());

        return new CommitteeTypeResource($committeeType);
    }

    /**
     * Display the specified resource.
     *
     * @param CommitteeType $committeeType
     * @return CommitteeTypeResource
     * @throws AuthorizationException
     */
    public function show(CommitteeType $committeeType)
    {
        $this->authorize('show', $committeeType);

        return new CommitteeTypeResource($committeeType);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param CommitteeType $committeeType
     * @return CommitteeTypeResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, CommitteeType $committeeType)
    {
        $this->authorize('update', $committeeType);

        $committeeType = $this->committeeTypeRepository->update($committeeType, $request->all());

        return new CommitteeTypeResource($committeeType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeType $committeeType
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(CommitteeType $committeeType)
    {
        $this->authorize('destroy', $committeeType);

        $this->committeeTypeRepository->delete($committeeType);

        return response()->json(null, 204);
    }
}
