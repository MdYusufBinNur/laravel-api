<?php

namespace App\Http\Controllers;

use App\DbModels\ModuleOption;
use App\Http\Requests\ModuleOption\IndexRequest;
use App\Http\Requests\ModuleOption\StoreRequest;
use App\Http\Requests\ModuleOption\UpdateRequest;
use App\Http\Resources\ModuleOptionResource;
use App\Http\Resources\ModuleOptionResourceCollection;
use App\Repositories\Contracts\ModuleOptionRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ModuleOptionController extends Controller
{
    /**
     * @var ModuleOptionRepository
     */
    protected $moduleOptionRepository;

    /**
     * ModuleOptionController constructor.
     * @param ModuleOptionRepository $moduleOptionRepository
     */
    public function __construct(ModuleOptionRepository $moduleOptionRepository)
    {
        $this->moduleOptionRepository = $moduleOptionRepository;
    }

    /**
     * Display a listing of the ModuleOption resource.
     *
     * @param IndexRequest $request
     * @return ModuleOptionResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', ModuleOption::class);

        $moduleOptions = $this->moduleOptionRepository->findBy($request->all());

        return new ModuleOptionResourceCollection($moduleOptions);
    }

    /**
     * Store a newly created ModuleOption resource in storage.
     *
     * @param StoreRequest  $request
     * @return ModuleOptionResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', ModuleOption::class);

        $moduleOption = $this->moduleOptionRepository->save($request->all());

        return new ModuleOptionResource($moduleOption);
    }

    /**
     * Display the specified ModuleOption resource.
     *
     * @param ModuleOption $moduleOption
     * @return ModuleOptionResource
     * @throws AuthorizationException
     */
    public function show(ModuleOption $moduleOption)
    {
        $this->authorize('show', $moduleOption);

        return new ModuleOptionResource($moduleOption);
    }

    /**
     * Update the specified ModuleOption resource in storage.
     *
     * @param UpdateRequest $request
     * @param ModuleOption $moduleOption
     * @return ModuleOptionResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ModuleOption $moduleOption)
    {
        $this->authorize('update', $moduleOption);

        $moduleOption = $this->moduleOptionRepository->update($moduleOption, $request->all());

        return new ModuleOptionResource($moduleOption);
    }

    /**
     * Remove the specified ModuleOption resource from storage.
     *
     * @param ModuleOption $moduleOption
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ModuleOption $moduleOption)
    {
        $this->authorize('destroy', $moduleOption);

        $this->moduleOptionRepository->delete($moduleOption);

        return response()->json(null, 204);
    }
}
