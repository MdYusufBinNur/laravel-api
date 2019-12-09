<?php

namespace App\Http\Controllers;

use App\DbModels\Fdi;
use App\DbModels\Package;
use App\Http\Requests\Package\IndexRequest;
use App\Http\Requests\Package\StoreRequest;
use App\Http\Requests\Package\UpdateRequest;
use App\Http\Resources\PackageResource;
use App\Http\Resources\PackageResourceCollection;
use App\Repositories\Contracts\PackageRepository;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * @var PackageRepository
     */
    protected $packageRepository;

    /**
     * PackageController constructor.
     * @param PackageRepository $packageRepository
     */
    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * Display a listing of the Package resource.
     *
     * @param IndexRequest $request
     * @return PackageResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Package::class, $request->get('propertyId'), $request->get('unitId', null)]);

        $packages = $this->packageRepository->findBy($request->all());

        return new PackageResourceCollection($packages);
    }

    /**
     * Store a newly created Package resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PackageResource
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Package::class, $request->get('propertyId'), $request->get('unitId', null)]);

        $package = $this->packageRepository->save($request->all());

        return new PackageResource($package);
    }

    /**
     * Display the specified Package resource.
     * @param Package $package
     * @return PackageResource
     */
    public function show(Package $package)
    {
        $this->authorize('show', $package);

        return new PackageResource($package);
    }

    /**
     * Update the specified Package resource in storage.
     *
     * @param UpdateRequest $request
     * @param Package $package
     * @return PackageResource
     */
    public function update(UpdateRequest $request, Package $package)
    {
        $this->authorize('update', $package);

        $package = $this->packageRepository->update($package, $request->all());

        return new PackageResource($package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Package $package
     * @return void
     */
    public function destroy(Package $package)
    {
        $this->authorize('destroy', $package);

        $this->packageRepository->delete($package);

        return response()->json(null, 204);
    }
}
