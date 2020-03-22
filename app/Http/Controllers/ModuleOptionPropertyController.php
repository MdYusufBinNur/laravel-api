<?php

namespace App\Http\Controllers;

use App\DbModels\ModuleOptionProperty;
use App\Http\Requests\ModuleOptionProperty\IndexRequest;
use App\Http\Requests\ModuleOptionProperty\StoreRequest;
use App\Http\Requests\ModuleOptionProperty\UpdateRequest;
use App\Http\Resources\ModuleOptionPropertyResource;
use App\Http\Resources\ModuleOptionPropertyResourceCollection;
use App\Repositories\Contracts\ModuleOptionPropertyRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ModuleOptionPropertyController extends Controller
{
    /**
     * @var ModuleOptionPropertyRepository
     */
    protected $moduleOptionPropertyRepository;

    /**
     * ModuleOptionPropertyController constructor.
     * @param ModuleOptionPropertyRepository $moduleOptionPropertyRepository
     */
    public function __construct(ModuleOptionPropertyRepository $moduleOptionPropertyRepository)
    {
        $this->moduleOptionPropertyRepository = $moduleOptionPropertyRepository;
    }

    /**
     * Display a listing of the ModuleOptionProperty resource.
     *
     * @param IndexRequest $request
     * @return ModuleOptionPropertyResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ModuleOptionProperty::class, $request->input('propertyId')]);

        $moduleOptionProperties = $this->moduleOptionPropertyRepository->findBy($request->all());

        return new ModuleOptionPropertyResourceCollection($moduleOptionProperties);
    }

    /**
     * Store a newly created ModuleOptionProperty resource in storage.
     *
     * @param StoreRequest $request
     * @return ModuleOptionPropertyResourceCollection
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ModuleOptionProperty::class, $request->input('propertyId')]);

        $moduleOptionProperty = $this->moduleOptionPropertyRepository->saveModuleOptionProperty($request->all());

        return new ModuleOptionPropertyResourceCollection($moduleOptionProperty);

    }

    /**
     * Display the specified ModuleOptionProperty resource.
     *
     * @param ModuleOptionProperty $moduleOptionProperty
     * @return ModuleOptionPropertyResource
     * @throws AuthorizationException
     */
    public function show(ModuleOptionProperty $moduleOptionProperty)
    {
        $this->authorize('show', $moduleOptionProperty);

        return new ModuleOptionPropertyResource($moduleOptionProperty);
    }

    /**
     * Update the specified ModuleOptionProperty resource in storage.
     *
     * @param UpdateRequest $request
     * @param ModuleOptionProperty $moduleOptionProperty
     * @return ModuleOptionPropertyResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ModuleOptionProperty $moduleOptionProperty)
    {
        $this->authorize('update', $moduleOptionProperty);

        $moduleOptionProperty = $this->moduleOptionPropertyRepository->update($moduleOptionProperty, $request->all());

        return new ModuleOptionPropertyResource($moduleOptionProperty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ModuleOptionProperty $moduleOptionProperty
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ModuleOptionProperty $moduleOptionProperty)
    {
        $this->authorize('destroy', $moduleOptionProperty);

        $this->moduleOptionPropertyRepository->delete($moduleOptionProperty);

        return response()->json(null, 204);
    }
}
