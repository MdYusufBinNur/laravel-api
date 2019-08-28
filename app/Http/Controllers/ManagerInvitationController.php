<?php

namespace App\Http\Controllers;

use App\DbModels\ManagerInvitation;
use App\Http\Requests\ManagerInvitation\IndexRequest;
use App\Http\Requests\ManagerInvitation\StoreRequest;
use App\Http\Requests\ManagerInvitation\UpdateRequest;
use App\Http\Resources\ManagerInvitationResource;
use App\Http\Resources\ManagerInvitationResourceCollection;
use App\Repositories\Contracts\MangerInvitationRepository;

class ManagerInvitationController extends Controller
{

    /**
     * @var MangerInvitationRepository
     */
    protected $mangerInvitationRepository;

    /**
     * ManagerInvitationController constructor.
     * @param MangerInvitationRepository $mangerInvitationRepository
     */
    public function __construct(MangerInvitationRepository $mangerInvitationRepository)
    {
        $this->mangerInvitationRepository = $mangerInvitationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ManagerInvitationResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $managerInvitations = $this->mangerInvitationRepository->findBy(($request->all()));

        return new ManagerInvitationResourceCollection($managerInvitations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ManagerInvitationResource
     */
    public function store(StoreRequest $request)
    {
        $managerInvitation = $this->mangerInvitationRepository->save($request->all());

        return new ManagerInvitationResource($managerInvitation);
    }

    /**
     * Display the specified resource.
     *
     * @param ManagerInvitation $managerInvitation
     * @return ManagerInvitationResource
     */
    public function show(ManagerInvitation $managerInvitation)
    {
        return new ManagerInvitationResource($managerInvitation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ManagerInvitation $managerInvitation
     * @return ManagerInvitationResource
     */
    public function update(UpdateRequest $request, ManagerInvitation $managerInvitation)
    {
        $managerInvitation = $this->mangerInvitationRepository->update($managerInvitation,$request->all());

        return new ManagerInvitationResource($managerInvitation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManagerInvitation $managerInvitation
     * @return void
     */
    public function destroy(ManagerInvitation $managerInvitation)
    {
        $this->mangerInvitationRepository->delete($managerInvitation);

        return response()->json(null,204);
    }
}
