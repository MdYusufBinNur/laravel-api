<?php

namespace App\Http\Controllers;

use App\DbModels\CommitteeSession;
use App\Http\Requests\CommitteeSession\IndexRequest;
use App\Http\Requests\CommitteeSession\StoreRequest;
use App\Http\Requests\CommitteeSession\UpdateRequest;
use App\Http\Resources\CommitteeSessionResource;
use App\Http\Resources\CommitteeSessionResourceCollection;
use App\Repositories\Contracts\CommitteeSessionRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class CommitteeSessionController extends Controller
{
    /**
     * @var committeeSessionRepository
     */
    protected $committeeSessionRepository;

    /**
     * CommitteeSessionController constructor.
     * @param CommitteeSessionRepository $committeeSessionRepository
     */
    public function __construct(CommitteeSessionRepository $committeeSessionRepository)
    {
        $this->committeeSessionRepository = $committeeSessionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CommitteeSessionResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [CommitteeSession::class, $request->get('propertyId')]);

        $committeeSessions = $this->committeeSessionRepository->findBy($request->all());

        return new CommitteeSessionResourceCollection($committeeSessions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return CommitteeSessionResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [CommitteeSession::class, $request->get('propertyId')]);

        $committeeSession = $this->committeeSessionRepository->save($request->all());

        return new CommitteeSessionResource($committeeSession);
    }

    /**
     * Display the specified resource.
     *
     * @param CommitteeSession $committeeSession
     * @return CommitteeSessionResource
     * @throws AuthorizationException
     */
    public function show(CommitteeSession $committeeSession)
    {
        $this->authorize('show', $committeeSession);

        return new CommitteeSessionResource($committeeSession);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param CommitteeSession $committeeSession
     * @return CommitteeSessionResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, CommitteeSession $committeeSession)
    {
        $this->authorize('update', $committeeSession);

        $committeeSession = $this->committeeSessionRepository->update($committeeSession, $request->all());

        return new CommitteeSessionResource($committeeSession);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeSession $committeeSession
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(CommitteeSession $committeeSession)
    {
        $this->authorize('destroy', $committeeSession);

        $this->committeeSessionRepository->delete($committeeSession);

        return response()->json(null, 204);
    }
}
