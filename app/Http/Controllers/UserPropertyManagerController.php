<?php

namespace App\Http\Controllers;

use App\DbModels\UserPropertyManager;
use App\Http\Requests\UserPropertyManager\IndexRequest;
use App\Http\Requests\UserPropertyManager\StoreRequest;
use App\Http\Requests\UserPropertyManager\UpdateRequest;
use App\Http\Resources\UserPropertyManagerResource;
use App\Http\Resources\UserPropertyManagerResourceCollection;
use App\Repositories\Contracts\UserPropertyManagerRepository;

class UserPropertyManagerController extends Controller
{
    /**
     * @var UserPropertyManagerRepository
     */
    protected $userPropertyManagerRepository;

    /**
     * UserPropertyManagerController constructor.
     * @param UserPropertyManagerRepository $userPropertyManagerRepository
     */
    public function __construct(UserPropertyManagerRepository $userPropertyManagerRepository)
    {
        $this->userPropertyManagerRepository = $userPropertyManagerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserPropertyManagerResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $userPropertyManagers = $this->userPropertyManagerRepository->findBy($request->all());

        return new UserPropertyManagerResourceCollection($userPropertyManagers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserPropertyManagerResource
     */
    public function store(StoreRequest $request)
    {
        $userPropertyManager = $this->userPropertyManagerRepository->save($request->all());

        return new UserPropertyManagerResource($userPropertyManager);
    }

    /**
     * Display the specified resource.
     *
     * @param UserPropertyManager $userPropertyManager
     * @return UserPropertyManagerResource
     */
    public function show(UserPropertyManager $userPropertyManager)
    {
        return new UserPropertyManagerResource($userPropertyManager);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserPropertyManager $userPropertyManager
     * @return UserPropertyManagerResource
     */
    public function update(UpdateRequest $request, UserPropertyManager $userPropertyManager)
    {
        $userPropertyManager = $this->userPropertyManagerRepository->update($userPropertyManager, $request->all());

        return new UserPropertyManagerResource($userPropertyManager);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserPropertyManager $userPropertyManager
     * @return void
     */
    public function destroy(UserPropertyManager $userPropertyManager)
    {
        $this->userPropertyManagerRepository->delete($userPropertyManager);

        return response()->json(null, 204);
    }
}
