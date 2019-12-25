<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyGeneralInfo;
use App\Http\Requests\PropertyGeneralInfo\IndexRequest;
use App\Http\Requests\PropertyGeneralInfo\StoreRequest;
use App\Http\Requests\PropertyGeneralInfo\UpdateRequest;
use App\Http\Resources\PropertyGeneralInfoResource;
use App\Http\Resources\PropertyGeneralInfoResourceCollection;
use App\Repositories\Contracts\PropertyGeneralInfoRepository;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PropertyGeneralInfo::class, $request->get('propertyId')]);

        $propertyGeneralInfos = $this->propertyGeneralInfoRepository->findBy($request->all());

        return new PropertyGeneralInfoResourceCollection($propertyGeneralInfos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PropertyGeneralInfoResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PropertyGeneralInfo::class, $request->get('propertyId')]);

        $propertyGeneralInfo = $this->propertyGeneralInfoRepository->save($request->all());

        return new PropertyGeneralInfoResource($propertyGeneralInfo);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return PropertyGeneralInfoResource
     * @throws AuthorizationException
     */
    public function show(PropertyGeneralInfo $propertyGeneralInfo)
    {
        $this->authorize('show', $propertyGeneralInfo);

        return new PropertyGeneralInfoResource($propertyGeneralInfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return PropertyGeneralInfoResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PropertyGeneralInfo $propertyGeneralInfo)
    {
        $this->authorize('update', $propertyGeneralInfo);

        $propertyGeneralInfo = $this->propertyGeneralInfoRepository->update($propertyGeneralInfo, $request->all());

        return new PropertyGeneralInfoResource($propertyGeneralInfo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PropertyGeneralInfo $propertyGeneralInfo)
    {
        $this->authorize('destroy', $propertyGeneralInfo);

        $this->propertyGeneralInfoRepository->delete($propertyGeneralInfo);

        return response()->json(null, 204);
    }
}
