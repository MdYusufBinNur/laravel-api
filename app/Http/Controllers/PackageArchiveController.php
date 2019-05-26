<?php

namespace App\Http\Controllers;

use App\DbModels\PackageArchive;
use App\Http\Requests\PackageArchive\IndexRequest;
use App\Http\Requests\PackageArchive\StoreRequest;
use App\Http\Requests\PackageArchive\UpdateRequest;
use App\Http\Resources\PackageArchiveResource;
use App\Http\Resources\PackageArchiveResourceCollection;
use App\Repositories\Contracts\PackageArchiveRepository;
use Illuminate\Http\Request;

class PackageArchiveController extends Controller
{
    /**
     * @var PackageArchiveRepository
     */
    protected $packageArchiveRepository;

    /**
     * PackageArchiveController constructor.
     * @param PackageArchiveRepository $packageArchiveRepository
     */
    public function __construct(PackageArchiveRepository $packageArchiveRepository)
    {
        $this->packageArchiveRepository = $packageArchiveRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PackageArchiveResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $packageArchives = $this->packageArchiveRepository->findBy($request->all());

        return new PackageArchiveResourceCollection($packageArchives);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return PackageArchiveResource
     */
    public function store(StoreRequest $request)
    {
        $packageArchive = $this->packageArchiveRepository->save($request->all());

        return new PackageArchiveResource($packageArchive);
    }

    /**
     * Display the specified resource.
     *
     * @param PackageArchive $packageArchive
     * @return PackageArchiveResource
     */
    public function show(PackageArchive $packageArchive)
    {
        return new PackageArchiveResource($packageArchive);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PackageArchive $packageArchive
     * @return PackageArchiveResource
     */
    public function update(UpdateRequest $request, PackageArchive $packageArchive)
    {
        $packageArchive = $this->packageArchiveRepository->update($packageArchive, $request->all());

        return new PackageArchiveResource($packageArchive);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PackageArchive $packageArchive
     * @return void
     */
    public function destroy(PackageArchive $packageArchive)
    {
        $this->packageArchiveRepository->delete($packageArchive);

        return response()->json(null, 204);
    }
}
