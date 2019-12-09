<?php

namespace App\Http\Controllers;

use App\DbModels\Module;
use App\Http\Requests\Module\IndexRequest;
use App\Http\Requests\Module\StoreRequest;
use App\Http\Requests\Module\UpdateRequest;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\ModuleResourceCollection;
use App\Repositories\Contracts\ModuleRepository;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', Module::class);

        $modules = $this->moduleRepository->findBy($request->all());

        return new ModuleResourceCollection($modules);
    }

    /**
     * Store a newly created Module resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ModuleResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', Module::class);

        $module = $this->moduleRepository->save($request->all());

        return new ModuleResource($module);
    }

    /**
     * Display the specified Module resource.
     *
     * @param Module $module
     * @return ModuleResource
     * @throws AuthorizationException
     */
    public function show(Module $module)
    {
        $this->authorize('show', $module);

        return new ModuleResource($module);
    }

    /**
     * Update the specified Module resource in storage.
     *
     * @param UpdateRequest $request
     * @param Module $module
     * @return ModuleResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Module $module)
    {
        $this->authorize('update', $module);

        $module = $this->moduleRepository->update($module, $request->all());

        return new ModuleResource($module);
    }

    /**
     * Remove the specified Module resource from storage.
     *
     * @param Module $module
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Module $module)
    {
        $this->authorize('destroy', $module);

        $this->moduleRepository->delete($module);

        return response()->json(null, 204);
    }
}
