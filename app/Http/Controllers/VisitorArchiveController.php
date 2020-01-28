<?php

namespace App\Http\Controllers;

use App\DbModels\VisitorArchive;
use App\Http\Requests\VisitorArchive\IndexRequest;
use App\Http\Requests\VisitorArchive\StoreRequest;
use App\Http\Requests\VisitorArchive\UpdateRequest;
use App\Http\Resources\VisitorArchiveResource;
use App\Http\Resources\VisitorArchiveResourceCollection;
use App\Repositories\Contracts\VisitorArchiveRepository;
use Illuminate\Auth\Access\AuthorizationException;

class VisitorArchiveController extends Controller
{
    /**
     * @var VisitorArchiveRepository
     */
    protected $visitorArchiveRepository;

    /**
     * VisitorArchiveController constructor.
     * @param VisitorArchiveRepository $visitorArchiveRepository
     */
    public function __construct(VisitorArchiveRepository $visitorArchiveRepository)
    {
        $this->visitorArchiveRepository = $visitorArchiveRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return VisitorArchiveResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [VisitorArchive::class, $request->get('propertyId'), $request->get('unitId', null)]);

        $visitorArchives = $this->visitorArchiveRepository->findBy($request->all());

        return new VisitorArchiveResourceCollection($visitorArchives);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return VisitorArchiveResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [VisitorArchive::class, $request->get('propertyId')]);

        $visitorArchive = $this->visitorArchiveRepository->save($request->all());

        return new VisitorArchiveResource($visitorArchive);
    }

    /**
     * Display the specified resource.
     *
     * @param VisitorArchive $visitorArchive
     * @return VisitorArchiveResource
     * @throws AuthorizationException
     */
    public function show(VisitorArchive $visitorArchive)
    {
        $this->authorize('show', $visitorArchive);

        return new VisitorArchiveResource($visitorArchive);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param VisitorArchive $visitorArchive
     * @return VisitorArchiveResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, VisitorArchive $visitorArchive)
    {
        $this->authorize('update', $visitorArchive);

        $visitorArchive = $this->visitorArchiveRepository->update($visitorArchive,$request->all());

        return new VisitorArchiveResource($visitorArchive);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VisitorArchive $visitorArchive
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(VisitorArchive $visitorArchive)
    {
        $this->authorize('destroy', $visitorArchive);
        $this->visitorArchiveRepository->delete($visitorArchive);

        return response()->json(null,204);
    }
}
