<?php

namespace App\Http\Controllers;

use App\DbModels\UserProfileChild;
use App\Http\Requests\UserProfileChild\IndexRequest;
use App\Http\Requests\UserProfileChild\StoreRequest;
use App\Http\Requests\UserProfileChild\UpdateRequest;
use App\Http\Resources\UserProfileChildResource;
use App\Http\Resources\UserProfileChildResourceCollection;
use App\Repositories\Contracts\UserProfileChildRepository;
use Illuminate\Http\Request;

class UserProfileChildController extends Controller
{
    /**
     * @var UserProfileChildRepository
     */
    protected $userProfileChildRepository;

    /**
     * UserProfileChildController constructor.
     * @param UserProfileChildRepository $userProfileChildRepository
     */
    public function __construct(UserProfileChildRepository $userProfileChildRepository)
    {
        $this->userProfileChildRepository = $userProfileChildRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserProfileChildResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $userProfileChildren = $this->userProfileChildRepository->findBy($request->all());

        return new UserProfileChildResourceCollection($userProfileChildren);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return UserProfileChildResource
     */
    public function store(StoreRequest $request)
    {
        $userProfileChild = $this->userProfileChildRepository->save($request->all());

        return new UserProfileChildResource($userProfileChild);
    }

    /**
     * Display the specified resource.
     *
     * @param UserProfileChild $userProfileChild
     * @return UserProfileChildResource
     */
    public function show(UserProfileChild $userProfileChild)
    {
        return new UserProfileChildResource($userProfileChild);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserProfileChild $userProfileChild
     * @return UserProfileChildResource
     */
    public function update(UpdateRequest $request, UserProfileChild $userProfileChild)
    {
        $userProfileChild = $this->userProfileChildRepository->update($userProfileChild,$request->all());

        return new UserProfileChildResource($userProfileChild);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserProfileChild $userProfileChild
     * @return void
     */
    public function destroy(UserProfileChild $userProfileChild)
    {
        $this->userProfileChildRepository->delete($userProfileChild);

        return response()->json(null,204);
    }
}
