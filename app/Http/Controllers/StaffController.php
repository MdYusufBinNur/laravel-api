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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Manager::class, $request->input('propertyId')]);

        $users = $this->managerRepository->findStaffUsers($request->all());

        return new StaffResourceCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return StaffResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Manager::class, $request->input('propertyId')]);

        $staff = $this->managerRepository->save($request->all());

        return new StaffResource($staff);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return StaffResource
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $staff = $this->managerRepository->findOne($id);

        if (!$staff instanceof Manager) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        $this->authorize('show', $staff);

        return new StaffResource($staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Manager $staff
     * @return StaffResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Manager $staff)
    {
        $this->authorize('update', $staff);

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
        $this->authorize('destroy', $staff);

        $this->managerRepository->deleteStaff($staff, $request->all());

        return response()->json(null, 204);
    }
}
