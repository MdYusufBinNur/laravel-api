<?php

namespace App\Http\Controllers;

use App\DbModels\ModuleProperty;
use App\Http\Requests\ModuleProperty\IndexRequest;
use App\Http\Requests\ModuleProperty\StoreRequest;
use App\Http\Requests\ModuleProperty\UpdateRequest;
use App\Http\Resources\ModulePropertyResource;
use App\Http\Resources\ModulePropertyResourceCollection;
use App\Repositories\Contracts\ModulePropertyRepository;

class ModulePropertyController extends Controller
{
    /**
     * @var ModulePropertyRepository
     */
    protected $modulePropertyRepository;

    /**
     * ModulePropertyController constructor.
     *
     * @param ModulePropertyRepository $modulePropertyRepository
     */
    public function __construct(ModulePropertyRepository $modulePropertyRepository)
    {
        $this->modulePropertyRepository = $modulePropertyRepository;
    }

    /**
     * Display a listing of the ModuleProperty resource.
     *
     * @param IndexRequest $request
     * @return ModulePropertyResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $moduleProperties = $this->modulePropertyRepository->findBy($request->all());

        return new ModulePropertyResourceCollection($moduleProperties);
    }

    /**
     * Store a newly created ModuleProperty resource in storage.
     *
     * @param StoreRequest  $request
     * @return ModulePropertyResource
     */
    public function store(StoreRequest $request)
    {
        $moduleProperty = $this->modulePropertyRepository->setModuleProperty($request->all());

        return new ModulePropertyResource($moduleProperty);
    }

    /**
     * Display the specified ModuleProperty resource.
     *
     * @param ModuleProperty $moduleProperty
     * @return ModulePropertyResource
     */
    public function show(ModuleProperty $moduleProperty)
    {
        return new ModulePropertyResource($moduleProperty);
    }

    /**
     * Update the specified ModuleProperty resource in storage.
     *
     * @param UpdateRequest $request
     * @param ModuleProperty $moduleProperty
     * @return ModulePropertyResource
     */
    public function update(UpdateRequest $request, ModuleProperty $moduleProperty)
    {
        $moduleProperty = $this->modulePropertyRepository->setModuleProperty($moduleProperty, $request->all());

        return new ModulePropertyResource($moduleProperty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ModuleProperty $moduleProperty
     * @return void
     */
    public function destroy(ModuleProperty $moduleProperty)
    {
        $this->modulePropertyRepository->delete($moduleProperty);

        return response()->json(null, 204);
    }
}
