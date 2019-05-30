<?php

namespace App\Http\Controllers;

use App\DbModels\UserProfile;
use App\Http\Requests\UserProfile\IndexRequest;
use App\Http\Requests\UserProfile\StoreRequest;
use App\Http\Requests\UserProfile\UpdateRequest;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\UserProfileResourceCollection;
use App\Repositories\Contracts\UserProfileRepository;

class UserProfileController extends Controller
{
    /**
     * @var UserProfileRepository
     */
    protected $userProfileRepository;

    /**
     * UserProfileController constructor.
     * @param UserProfileRepository $userProfileRepository
     */
    public function __construct(UserProfileRepository $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserProfileResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $userProfiles = $this->userProfileRepository->findBy($request->all());
        
        return new UserProfileResourceCollection($userProfiles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return UserProfileResource
     */
    public function store(StoreRequest $request)
    {
        $userProfile = $this->userProfileRepository->save($request->all());
        
        return new UserProfileResource($userProfile);
    }

    /**
     * Display the specified resource.
     *
     * @param UserProfile $userProfile
     * @return UserProfileResource
     */
    public function show(UserProfile $userProfile)
    {
        return new UserProfileResource($userProfile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserProfile $userProfile
     * @return UserProfileResource
     */
    public function update(UpdateRequest $request, UserProfile $userProfile)
    {
        $userProfile = $this->userProfileRepository->update($userProfile,$request->all());

        return new UserProfileResource($userProfile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserProfile $userProfile
     * @return void
     */
    public function destroy(UserProfile $userProfile)
    {
        $this->userProfileRepository->delete($userProfile);
        
        return response()->json(null,203);
    }
}
