<?php

namespace App\Http\Controllers;

use App\DbModels\Role;
use App\DbModels\Tower;
use App\Http\Requests\Role\IndexRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleResourceCollection;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * RoleController constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RoleResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $roles = $this->roleRepository->findBy($request->all());

        return new RoleResourceCollection($roles);
    }

    /**
     * create a Role
     *
     * @param  StoreRequest $request
     * @return RoleResource
     */
    public function store(StoreRequest $request)
    {
        $role = $this->roleRepository->save($request->all());

        return new RoleResource($role);
    }

    /**
     * Display the specified Role resource.
     *
     * @param Tower $tower
     * @return RoleResource
     */
    public function show(Tower $tower)
    {
        return new RoleResource($tower);
    }

    /**
     * Update the specified Role resource in storage.
     *
     * @param UpdateRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function update(UpdateRequest $request, Role $role)
    {
        $role = $this->roleRepository->update($role, $request->all());

        return new RoleResource($role);
    }

    /**
     * Remove the specified Role resource from storage.
     *
     * @param Role $role
     * @return void
     */
    public function destroy(Role $role)
    {
        $this->roleRepository->delete($role);

        return response()->json(null, 204);
    }
}
