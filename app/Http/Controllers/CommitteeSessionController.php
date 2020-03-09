<?php

namespace App\Http\Controllers;

use App\DbModels\CommitteeSession;
use App\Http\Requests\CommitteeSession\IndexRequest;
use App\Http\Requests\CommitteeSession\StoreRequest;
use App\Http\Requests\CommitteeSession\UpdateRequest;
use App\Http\Resources\CommitteeSessionResource;
use App\Http\Resources\CommitteeSessionResourceCollection;
use App\Repositories\Contracts\CommitteeSessionRepository;
use Illuminate\Http\Request;

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
     */
    public function index(IndexRequest $request)
    {
        $committeeSessions = $this->committeeSessionRepository->findBy($request->all());

        return new CommitteeSessionResourceCollection($committeeSessions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CommitteeSessionResource
     */
    public function store(StoreRequest $request)
    {
        $committeeSession = $this->committeeSessionRepository->save($request->all());

        return new CommitteeSessionResource($committeeSession);
    }

    /**
     * Display the specified resource.
     *
     * @param CommitteeSession $committeeSession
     * @return CommitteeSessionResource
     */
    public function show(CommitteeSession $committeeSession)
    {
        return new CommitteeSessionResource($committeeSession);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param CommitteeSession $committeeSession
     * @return CommitteeSessionResource
     */
    public function update(UpdateRequest $request, CommitteeSession $committeeSession)
    {
        $committeeSession = $this->committeeSessionRepository->update($committeeSession, $request->all());

        return new CommitteeSessionResource($committeeSession);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeSession $committeeSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommitteeSession $committeeSession)
    {
        $this->committeeSessionRepository->delete($committeeSession);

        return response()->json(null, 204);
    }
}
