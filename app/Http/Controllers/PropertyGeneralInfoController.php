<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyGeneralInfo;
use App\Http\Requests\PropertyGeneralInfo\IndexRequest;
use App\Http\Requests\PropertyGeneralInfo\StoreRequest;
use App\Http\Requests\PropertyGeneralInfo\UpdateRequest;
use App\Http\Resources\PropertyGeneralInfoResource;
use App\Http\Resources\PropertyGeneralInfoResourceCollection;
use App\Repositories\Contracts\PropertyGeneralInfoRepository;
use Illuminate\Http\Request;

class PropertyGeneralInfoController extends Controller
{
    /**
     * @var PropertyGeneralInfoRepository
     */
    protected $propertyGeneralInfoRepository;

    /**
     * PropertyGeneralInfoController constructor.
     * @param PropertyGeneralInfoRepository $propertyGeneralInfoRepository
     */
    public function __construct(PropertyGeneralInfoRepository $propertyGeneralInfoRepository)
    {
        $this->propertyGeneralInfoRepository = $propertyGeneralInfoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PropertyGeneralInfoResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $propertyGeneralInfos = $this->propertyGeneralInfoRepository->findBy($request->all());

        return new PropertyGeneralInfoResourceCollection($propertyGeneralInfos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PropertyGeneralInfoResource
     */
    public function store(StoreRequest $request)
    {
        $propertyGeneralInfo = $this->propertyGeneralInfoRepository->save($request->all());

        return new PropertyGeneralInfoResource($propertyGeneralInfo);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return PropertyGeneralInfoResource
     */
    public function show(PropertyGeneralInfo $propertyGeneralInfo)
    {
        return new PropertyGeneralInfoResource($propertyGeneralInfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return PropertyGeneralInfoResource
     */
    public function update(UpdateRequest $request, PropertyGeneralInfo $propertyGeneralInfo)
    {
        $propertyGeneralInfo = $this->propertyGeneralInfoRepository->update($propertyGeneralInfo, $request->all());

        return new PropertyGeneralInfoResource($propertyGeneralInfo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return void
     */
    public function destroy(PropertyGeneralInfo $propertyGeneralInfo)
    {
        $this->propertyGeneralInfoRepository->delete($propertyGeneralInfo);

        return response()->json(null, 204);
    }
}
