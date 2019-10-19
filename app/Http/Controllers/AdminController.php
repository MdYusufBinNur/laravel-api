<?php

namespace App\Http\Controllers;

use App\DbModels\Admin;
use App\Http\Requests\Admin\IndexRequest;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\AdminResourceCollection;
use App\Repositories\Contracts\AdminRepository;

class AdminController extends Controller
{
    /**
     * @var AdminRepository
     */
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return AdminResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $admins = $this->adminRepository->findBy($request->all());

        return new AdminResourceCollection($admins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return AdminResource
     */
    public function store(StoreRequest $request)
    {
        $admin = $this->adminRepository->save($request->all());

        return new AdminResource($admin);
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return AdminResource
     */
    public function show(Admin $admin)
    {
        return new AdminResource($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Admin $admin
     * @return AdminResource
     */
    public function update(UpdateRequest $request, Admin $admin)
    {
        $admin = $this->adminRepository->update($admin,$request->all());

        return new AdminResource($admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->adminRepository->delete($admin);

        return response()->json(null, 204);
    }
}
