<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyCommittee;
use App\Http\Requests\PropertyCommittee\IndexRequest;
use App\Http\Requests\PropertyCommittee\StoreRequest;
use App\Http\Requests\PropertyCommittee\UpdateRequest;
use App\Http\Resources\PropertyCommitteeResource;
use App\Http\Resources\PropertyCommitteeResourceCollection;
use App\Repositories\Contracts\PropertyCommitteeRepository;
use Illuminate\Http\Request;

class PropertyCommitteeController extends Controller
{
    /**
     * @var PropertyCommitteeRepository
     */
    protected $propertyCommitteeRepository;

    /**
     * PropertyCommitteeController constructor.
     * @param PropertyCommitteeRepository $propertyCommitteeRepository
     */
    public function __construct(PropertyCommitteeRepository $propertyCommitteeRepository)
    {
        $this->propertyCommitteeRepository = $propertyCommitteeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PropertyCommitteeResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $propertyCommittees = $this->propertyCommitteeRepository->findBy($request->all());

        return new PropertyCommitteeResourceCollection($propertyCommittees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PropertyCommitteeResource
     */
    public function store(StoreRequest $request)
    {
        $propertyCommittee = $this->propertyCommitteeRepository->save($request->all());

        return new PropertyCommitteeResource($propertyCommittee);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyCommittee $propertyCommittee
     * @return PropertyCommitteeResource
     */
    public function show(PropertyCommittee $propertyCommittee)
    {
        return new PropertyCommitteeResource($propertyCommittee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyCommittee $propertyCommittee
     * @return PropertyCommitteeResource
     */
    public function update(UpdateRequest $request, PropertyCommittee $propertyCommittee)
    {
        $propertyCommittee = $this->propertyCommitteeRepository->update($propertyCommittee, $request->all());

        return new PropertyCommitteeResource($propertyCommittee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyCommittee $propertyCommittee
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyCommittee $propertyCommittee)
    {
        $this->propertyCommitteeRepository->delete($propertyCommittee);

        return response()->json(null ,204);
    }
}
