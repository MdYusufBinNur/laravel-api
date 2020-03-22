<?php

namespace App\Http\Controllers;

use App\DbModels\PackageType;
use App\Http\Requests\PackageType\IndexRequest;
use App\Http\Requests\PackageType\StoreRequest;
use App\Http\Requests\PackageType\UpdateRequest;
use App\Http\Resources\PackageTypeResource;
use App\Http\Resources\PackageTypeResourceCollection;
use App\Repositories\Contracts\PackageTypeRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PackageTypeController extends Controller
{
    /**
     * @var PackageTypeRepository
     */
    protected $packageTypeRepository;

    /**
     * PackageTypeController constructor.
     * @param PackageTypeRepository $packageTypeRepository
     */
    public function __construct(PackageTypeRepository $packageTypeRepository)
    {
        $this->packageTypeRepository = $packageTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PackageTypeResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PackageType::class, $request->input('propertyId')]);

        $packageTypes = $this->packageTypeRepository->findBy($request->all());

        return new PackageTypeResourceCollection($packageTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PackageTypeResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PackageType::class, $request->input('propertyId')]);

        $packageType = $this->packageTypeRepository->save($request->all());

        return new PackageTypeResource($packageType);
    }

    /**
     * Display the specified resource.
     *
     * @param PackageType $packageType
     * @return PackageTypeResource
     * @throws AuthorizationException
     */
    public function show(PackageType $packageType)
    {
        $this->authorize('show', $packageType);

        return new PackageTypeResource($packageType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PackageType $packageType
     * @return PackageTypeResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PackageType $packageType)
    {
        $this->authorize('update', $packageType);

        $packageType = $this->packageTypeRepository->update($packageType, $request->all());

        return new PackageTypeResource($packageType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PackageType $packageType
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PackageType $packageType)
    {
        $this->authorize('destroy', $packageType);

        $this->packageTypeRepository->delete($packageType);

        return response()->json(null, 204);
    }
}
