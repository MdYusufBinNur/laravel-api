<?php

namespace App\Http\Controllers;

use App\DbModels\CommitteeType;
use App\Http\Requests\CommitteeType\IndexRequest;
use App\Http\Requests\CommitteeType\StoreRequest;
use App\Http\Requests\CommitteeType\UpdateRequest;
use App\Http\Resources\CommitteeTypeResource;
use App\Http\Resources\CommitteeTypeResourceCollection;
use App\Repositories\Contracts\CommitteeTypeRepository;
use Illuminate\Http\Request;

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
     */
    public function index(IndexRequest $request)
    {
        $committeeTypes = $this->committeeTypeRepository->findBy($request->all());

        return new CommitteeTypeResourceCollection($committeeTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CommitteeTypeResource
     */
    public function store(StoreRequest $request)
    {
        $committeeType = $this->committeeTypeRepository->save($request->all());

        return new CommitteeTypeResource($committeeType);
    }

    /**
     * Display the specified resource.
     *
     * @param CommitteeType $committeeType
     * @return CommitteeTypeResource
     */
    public function show(CommitteeType $committeeType)
    {
        return new CommitteeTypeResource($committeeType);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param CommitteeType $committeeType
     * @return CommitteeTypeResource
     */
    public function update(UpdateRequest $request, CommitteeType $committeeType)
    {
        $committeeType = $this->committeeTypeRepository->update($committeeType, $request->all());

        return new CommitteeTypeResource($committeeType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeType $committeeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommitteeType $committeeType)
    {
        $this->committeeTypeRepository->delete($committeeType);

        return response()->json(null, 204);
    }
}
