<?php

namespace App\Http\Controllers;

use App\DbModels\ModuleOption;
use App\Http\Requests\ModuleOption\IndexRequest;
use App\Http\Requests\ModuleOption\StoreRequest;
use App\Http\Requests\ModuleOption\UpdateRequest;
use App\Http\Resources\ModuleOptionResource;
use App\Http\Resources\ModuleOptionResourceCollection;
use App\Repositories\Contracts\ModuleOptionRepository;
use http\Env\Response;
use Illuminate\Http\Request;

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
     */
    public function index(IndexRequest $request)
    {
        $moduleOptions = $this->moduleOptionRepository->findBy($request->all());

        return new ModuleOptionResourceCollection($moduleOptions);
    }

    /**
     * Store a newly created ModuleOption resource in storage.
     *
     * @param StoreRequest  $request
     * @return ModuleOptionResource
     */
    public function store(StoreRequest $request)
    {
        $moduleOption = $this->moduleOptionRepository->save($request->all());

        return new ModuleOptionResource($moduleOption);
    }

    /**
     * Display the specified ModuleOption resource.
     *
     * @param ModuleOption $moduleOption
     * @return ModuleOptionResource
     */
    public function show(ModuleOption $moduleOption)
    {
        return new ModuleOptionResource($moduleOption);
    }

    /**
     * Update the specified ModuleOption resource in storage.
     *
     * @param UpdateRequest $request
     * @param ModuleOption $moduleOption
     * @return ModuleOptionResource
     */
    public function update(UpdateRequest $request, ModuleOption $moduleOption)
    {
        $moduleOption = $this->moduleOptionRepository->update($moduleOption, $request->all());

        return new ModuleOptionResource($moduleOption);
    }

    /**
     * Remove the specified ModuleOption resource from storage.
     *
     * @param ModuleOption $moduleOption
     * @return void
     */
    public function destroy(ModuleOption $moduleOption)
    {
        $this->moduleOptionRepository->delete($moduleOption);

        return response()->json(null, 204);
    }
}
