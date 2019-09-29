<?php

namespace App\Http\Controllers;

use App\DbModels\Manager;
use App\Http\Requests\Staff\DestroyRequest;
use App\Http\Requests\Staff\IndexRequest;
use App\Http\Requests\Staff\StoreRequest;
use App\Http\Requests\Staff\UpdateRequest;
use App\Http\Resources\StaffResource;
use App\Http\Resources\StaffResourceCollection;
use App\Repositories\Contracts\ManagerRepository;
use Illuminate\Auth\Access\AuthorizationException;

class StaffController extends Controller
{
    /**
     * @var ManagerRepository
     */
    protected $managerRepository;

    /**
     * UserController constructor.
     *
     * @param ManagerRepository $managerRepository
     */
    public function __construct(ManagerRepository $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return StaffResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $users = $this->managerRepository->findStaffUsers($request->all());

        return new StaffResourceCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return StaffResource
     */
    public function store(StoreRequest $request)
    {
        $staff = $this->managerRepository->save($request->all());

        return new StaffResource($staff);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DbModels\User  $user
     * @return StaffResource
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $user = $this->managerRepository->findOne($id);

        if (!$user instanceof Manager) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        //$this->authorize('show', $user);

        return new StaffResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Manager $staff
     * @return StaffResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Manager $staff)
    {
        $staff = $this->managerRepository->updateManager($staff, $request->all());

        return new StaffResource($staff);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Manager $staff
     * @return null;
     * @throws AuthorizationException
     */
    public function destroy(DestroyRequest $request, Manager $staff)
    {
        $this->managerRepository->deleteStaff($staff, $request->all());
        return response()->json(null, 204);
    }
}
