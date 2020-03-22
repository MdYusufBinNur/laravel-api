<?php

namespace App\Http\Controllers;

use App\DbModels\Committee;
use App\Http\Requests\Committee\IndexRequest;
use App\Http\Requests\Committee\StoreRequest;
use App\Http\Requests\Committee\UpdateRequest;
use App\Http\Resources\CommitteeResource;
use App\Http\Resources\CommitteeResourceCollection;
use App\Repositories\Contracts\CommitteeRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class CommitteeController extends Controller
{
    /**
     * @var CommitteeRepository
     */
    protected $committeeRepository;

    /**
     * CommitteeController constructor.
     * @param CommitteeRepository $committeeRepository
     */
    public function __construct(CommitteeRepository $committeeRepository)
    {
        $this->committeeRepository = $committeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CommitteeResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Committee::class, $request->input('propertyId')]);

        $propertyCommittees = $this->committeeRepository->findBy($request->all());

        return new CommitteeResourceCollection($propertyCommittees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return CommitteeResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Committee::class, $request->input('propertyId')]);

        $propertyCommittee = $this->committeeRepository->save($request->all());

        return new CommitteeResource($propertyCommittee);
    }

    /**
     * Display the specified resource.
     *
     * @param Committee $committee
     * @return CommitteeResource
     * @throws AuthorizationException
     */
    public function show(Committee $committee)
    {
        $this->authorize('show', $committee);

        return new CommitteeResource($committee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Committee $committee
     * @return CommitteeResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Committee $committee)
    {
        $this->authorize('update', $committee);

        $propertyCommittee = $this->committeeRepository->update($committee, $request->all());

        return new CommitteeResource($propertyCommittee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Committee $committee
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Committee $committee)
    {
        $this->authorize('destroy', $committee);

        $this->committeeRepository->delete($committee);

        return response()->json(null ,204);
    }
}
