<?php

namespace App\Http\Controllers;

use App\DbModels\UserProfilePost;
use App\Http\Requests\UserProfilePost\IndexRequest;
use App\Http\Requests\UserProfilePost\StoreRequest;
use App\Http\Requests\UserProfilePost\UpdateRequest;
use App\Http\Resources\UserProfilePostResource;
use App\Http\Resources\UserProfilePostResourceCollection;
use App\Repositories\Contracts\UserProfilePostRepository;
use Illuminate\Http\Request;

class UserProfilePostController extends Controller
{
    /**
     * @var UserProfilePostRepository
     */
    protected $userProfilePostRepository;

    /**
     * UserProfilePostController constructor.
     * @param UserProfilePostRepository $userProfilePostRepository
     */
    public function __construct(UserProfilePostRepository $userProfilePostRepository)
    {
        $this->userProfilePostRepository = $userProfilePostRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserProfilePostResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $userProfilePosts = $this->userProfilePostRepository->findBy($request->all());

        return new UserProfilePostResourceCollection($userProfilePosts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return UserProfilePostResource
     */
    public function store(StoreRequest $request)
    {
        $userProfilePost = $this->userProfilePostRepository->save($request->all());

        return new UserProfilePostResource($userProfilePost);
    }

    /**
     * Display the specified resource.
     *
     * @param UserProfilePost $userProfilePost
     * @return UserProfilePostResource
     */
    public function show(UserProfilePost $userProfilePost)
    {
        return new UserProfilePostResource($userProfilePost);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserProfilePost $userProfilePost
     * @return UserProfilePostResource
     */
    public function update(UpdateRequest $request, UserProfilePost $userProfilePost)
    {
        $userProfilePost = $this->userProfilePostRepository->update($userProfilePost,$request->all());

        return new UserProfilePostResource($userProfilePost);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserProfilePost $userProfilePost
     * @return void
     */
    public function destroy(UserProfilePost $userProfilePost)
    {
        $this->userProfilePostRepository->delete($userProfilePost);

        return response()->json(null,204);
    }
}