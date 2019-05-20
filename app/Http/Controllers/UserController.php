<?php

namespace App\Http\Controllers;

use App\DbModels\User;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $users = $this->userRepository->findBy($request->all());

        return new UserResourceCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return UserResource
     */
    public function store(StoreRequest $request)
    {
        $user = $this->userRepository->save($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DbModels\User  $user
     * @return UserResource
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $user = $this->userRepository->findOne($id);

        if (!$user instanceof User) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  \App\DbModels\User  $user
     * @return UserResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user = $this->userRepository->update($user, $request->all());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DbModels\User  $user
     * @return null;
     * @throws AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user);
        return response()->json(null, 204);
    }
}
