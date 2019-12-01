<?php

namespace App\Http\Controllers;

use App\DbModels\ModuleSettingProperty;
use App\Http\Requests\ModuleSettingProperty\IndexRequest;
use App\Http\Requests\ModuleSettingProperty\StoreRequest;
use App\Http\Requests\ModuleSettingProperty\UpdateRequest;
use App\Http\Resources\ModuleSettingPropertyResource;
use App\Http\Resources\ModuleSettingPropertyResourceCollection;
use App\Repositories\Contracts\ModuleSettingPropertyRepository;

class ModuleSettingPropertyController extends Controller
{
    /**
     * @var ModuleSettingPropertyRepository
     */
    protected $moduleSettingPropertyRepository;

    /**
     * ModuleSettingPropertyController constructor.
     * @param ModuleSettingPropertyRepository $moduleSettingPropertyRepository
     */
    public function __construct(ModuleSettingPropertyRepository $moduleSettingPropertyRepository)
    {
        $this->moduleSettingPropertyRepository = $moduleSettingPropertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ModuleSettingPropertyResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $moduleSettingProperties = $this->moduleSettingPropertyRepository->findBy($request->all());

        return new ModuleSettingPropertyResourceCollection($moduleSettingProperties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ModuleSettingPropertyResource
     */
    public function store(StoreRequest $request)
    {
        $moduleSettingProperty = $this->moduleSettingPropertyRepository->save($request->all());

        return new ModuleSettingPropertyResource($moduleSettingProperty);
    }

    /**
     * Display the specified resource.
     *
     * @param ModuleSettingProperty $moduleSettingProperty
     * @return ModuleSettingPropertyResource
     */
    public function show(ModuleSettingProperty $moduleSettingProperty)
    {
        return new ModuleSettingPropertyResource($moduleSettingProperty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ModuleSettingProperty $moduleSettingProperty
     * @return ModuleSettingPropertyResource
     */
    public function update(UpdateRequest $request, ModuleSettingProperty $moduleSettingProperty)
    {
        $moduleSettingProperty = $this->moduleSettingPropertyRepository->update($moduleSettingProperty, $request->all());

        return new ModuleSettingPropertyResource($moduleSettingProperty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ModuleSettingProperty $moduleSettingProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModuleSettingProperty $moduleSettingProperty)
    {
        $this->moduleSettingPropertyRepository->delete($moduleSettingProperty);

        return response()->json(null, 204);
    }
}
