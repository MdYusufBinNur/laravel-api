<?php

namespace App\Http\Controllers;

use App\DbModels\PostApprovalBlacklistUnit;
use App\DbModels\PostWall;
use App\Http\Requests\PostApprovalBlacklistUnit\IndexRequest;
use App\Http\Requests\PostApprovalBlacklistUnit\StoreRequest;
use App\Http\Requests\PostApprovalBlacklistUnit\UpdateRequest;
use App\Http\Resources\PostApprovalBlacklistUnitResource;
use App\Http\Resources\PostApprovalBlacklistUnitResourceCollection;
use App\Repositories\Contracts\PostApprovalBlacklistUnitRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PostApprovalBlacklistUnitController extends Controller
{
    /**
     * @var PostApprovalBlacklistUnitRepository
     */
    protected $postApprovalBlacklistUnitRepository;

    /**
     * PostApprovalBlacklistUnitController constructor.
     * @param PostApprovalBlacklistUnitRepository $postApprovalBlacklistUnitRepository
     */
    public function __construct(PostApprovalBlacklistUnitRepository $postApprovalBlacklistUnitRepository)
    {
        $this->postApprovalBlacklistUnitRepository = $postApprovalBlacklistUnitRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostApprovalBlacklistUnitResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PostApprovalBlacklistUnit::class, $request->input('propertyId')]);

        $postApprovalBlacklistUnits = $this->postApprovalBlacklistUnitRepository->findBy($request->all());

        return new PostApprovalBlacklistUnitResourceCollection($postApprovalBlacklistUnits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return PostApprovalBlacklistUnitResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PostApprovalBlacklistUnit::class, $request->input('propertyId')]);

        $postApprovalBlacklistUnit = $this->postApprovalBlacklistUnitRepository->save($request->all());

        return new PostApprovalBlacklistUnitResource($postApprovalBlacklistUnit);
    }

    /**
     * Display the specified resource.
     *
     * @param PostApprovalBlacklistUnit $postApprovalBlacklistUnit
     * @return PostApprovalBlacklistUnitResource
     * @throws AuthorizationException
     */
    public function show(PostApprovalBlacklistUnit $postApprovalBlacklistUnit)
    {
        $this->authorize('show', $postApprovalBlacklistUnit);

        return new PostApprovalBlacklistUnitResource($postApprovalBlacklistUnit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostApprovalBlacklistUnit $postApprovalBlacklistUnit
     * @return PostApprovalBlacklistUnitResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PostApprovalBlacklistUnit $postApprovalBlacklistUnit)
    {
        $this->authorize('update', $postApprovalBlacklistUnit);

        $postApprovalBlacklistUnit = $this->postApprovalBlacklistUnitRepository->update($postApprovalBlacklistUnit,$request->all());

        return new PostApprovalBlacklistUnitResource($postApprovalBlacklistUnit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostApprovalBlacklistUnit $postApprovalBlacklistUnit
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PostApprovalBlacklistUnit $postApprovalBlacklistUnit)
    {
        $this->authorize('destroy', $postApprovalBlacklistUnit);

        $this->postApprovalBlacklistUnitRepository->delete($postApprovalBlacklistUnit);

        return response()->json(null,204);
    }
}
