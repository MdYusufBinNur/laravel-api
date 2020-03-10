<?php

namespace App\Http\Controllers;

use App\DbModels\CommitteeHierarchy;
use App\Http\Requests\CommitteeHierarchy\IndexRequest;
use App\Http\Requests\CommitteeHierarchy\StoreRequest;
use App\Http\Requests\CommitteeHierarchy\UpdateRequest;
use App\Http\Resources\CommitteeHierarchyResource;
use App\Http\Resources\CommitteeHierarchyResourceCollection;
use App\Repositories\Contracts\CommitteeHierarchyRepository;
use Illuminate\Auth\Access\AuthorizationException;

class CommitteeHierarchyController extends Controller
{
    /**
     * @var CommitteeHierarchyRepository
     */
    protected $committeeHierarchyRepository;

    /**
     * CommitteeHierarchyController constructor.
     * @param CommitteeHierarchyRepository $committeeHierarchyRepository
     */
    public function __construct(CommitteeHierarchyRepository $committeeHierarchyRepository)
    {
        $this->committeeHierarchyRepository = $committeeHierarchyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CommitteeHierarchyResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [CommitteeHierarchy::class, $request->get('propertyId')]);

        $committeeHierarchies = $this->committeeHierarchyRepository->findBy($request->all());

        return new CommitteeHierarchyResourceCollection($committeeHierarchies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CommitteeHierarchyResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [CommitteeHierarchy::class, $request->get('propertyId')]);

        $committeeHierarchy = $this->committeeHierarchyRepository->save($request->all());

        return new CommitteeHierarchyResource($committeeHierarchy);
    }

    /**
     * Display the specified resource.
     *
     * @param CommitteeHierarchy $committeeHierarchy
     * @return CommitteeHierarchyResource
     * @throws AuthorizationException
     */
    public function show(CommitteeHierarchy $committeeHierarchy)
    {
        $this->authorize('show', $committeeHierarchy);

        return new CommitteeHierarchyResource($committeeHierarchy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param CommitteeHierarchy $committeeHierarchy
     * @return CommitteeHierarchyResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, CommitteeHierarchy $committeeHierarchy)
    {
        $this->authorize('show', $committeeHierarchy);

        $committeeHierarchy = $this->committeeHierarchyRepository->update($committeeHierarchy, $request->all());

        return new CommitteeHierarchyResource($committeeHierarchy);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeHierarchy $committeeHierarchy
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(CommitteeHierarchy $committeeHierarchy)
    {
        $this->authorize('show', $committeeHierarchy);

        $this->committeeHierarchyRepository->delete($committeeHierarchy);

        return response()->json(null, 204);
    }
}
