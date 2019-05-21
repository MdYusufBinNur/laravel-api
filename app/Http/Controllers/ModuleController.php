<?php

namespace App\Http\Controllers;

use App\DbModels\Module;
use App\Http\Requests\Module\IndexRequest;
use App\Http\Requests\Module\StoreRequest;
use App\Http\Requests\Module\UpdateRequest;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\ModuleResourceCollection;
use App\Repositories\Contracts\ModuleRepository;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * @var ModuleRepository
     */
    protected $moduleRepository;

    /**
     * ModuleController constructor.
     * @param ModuleRepository $moduleRepository
     */
    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Display a listing of the Module resource.
     *
     * @param IndexRequest $request
     * @return ModuleResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $modules = $this->moduleRepository->findBy($request->all());

        return new ModuleResourceCollection($modules);
    }

    /**
     * Store a newly created Module resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ModuleResource
     */
    public function store(StoreRequest $request)
    {
        $module = $this->moduleRepository->save($request->all());

        return new ModuleResource($module);
    }

    /**
     * Display the specified Module resource.
     *
     * @param Module $module
     * @return ModuleResource
     */
    public function show(Module $module)
    {
        return new ModuleResource($module);
    }

    /**
     * Update the specified Module resource in storage.
     *
     * @param UpdateRequest $request
     * @param Module $module
     * @return ModuleResource
     */
    public function update(UpdateRequest $request, Module $module)
    {
        $module = $this->moduleRepository->update($module, $request->all());

        return new ModuleResource($module);
    }

    /**
     * Remove the specified Module resource from storage.
     *
     * @param Module $module
     * @return void
     */
    public function destroy(Module $module)
    {
        $this->moduleRepository->delete($module);

        return response()->json(null, 204);
    }
}
