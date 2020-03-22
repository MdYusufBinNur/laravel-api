<?php

namespace App\Http\Controllers;

use App\DbModels\ResidentArchive;
use App\Http\Requests\ResidentArchive\IndexRequest;
use App\Http\Requests\ResidentArchive\StoreRequest;
use App\Http\Requests\ResidentArchive\UpdateRequest;
use App\Http\Resources\ResidentArchiveResource;
use App\Http\Resources\ResidentArchiveResourceCollection;
use App\Repositories\Contracts\ResidentArchiveRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ResidentArchiveController extends Controller
{
    /**
     * @var ResidentArchiveRepository
     */
    protected $residentArchiveRepository;

    /**
     * ResidentArchiveController constructor.
     * @param ResidentArchiveRepository $residentArchiveRepository
     */
    public function __construct(ResidentArchiveRepository $residentArchiveRepository)
    {
        $this->residentArchiveRepository = $residentArchiveRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ResidentArchiveResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ResidentArchive::class, $request->input('propertyId')]);

        $residentArchives = $this->residentArchiveRepository->findBy($request->all());

        return new ResidentArchiveResourceCollection($residentArchives);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ResidentArchiveResourceCollection
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ResidentArchive::class, $request->input('propertyId')]);

        $residentArchives = $this->residentArchiveRepository->saveMultipleResidents($request->all());

        return new ResidentArchiveResourceCollection($residentArchives);
    }

    /**
     * Display the specified resource.
     *
     * @param ResidentArchive $residentArchive
     * @return ResidentArchiveResource
     * @throws AuthorizationException
     */
    public function show(ResidentArchive $residentArchive)
    {
        $this->authorize('show', $residentArchive);

        return new ResidentArchiveResource($residentArchive);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ResidentArchive $residentArchive
     * @return ResidentArchiveResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ResidentArchive $residentArchive)
    {
        $this->authorize('update', $residentArchive);

        $residentArchive = $this->residentArchiveRepository->update($residentArchive, $request->all());

        return new ResidentArchiveResource($residentArchive);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentArchive $residentArchive
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ResidentArchive $residentArchive)
    {
        $this->authorize('destroy', $residentArchive);

        $this->residentArchiveRepository->delete($residentArchive);

        return response()->json(null, 204);
    }
}
