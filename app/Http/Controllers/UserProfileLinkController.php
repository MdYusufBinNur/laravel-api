<?php

namespace App\Http\Controllers;

use App\DbModels\UserProfileLink;
use App\DbModels\UserProfilePost;
use App\Http\Requests\UserProfileLink\IndexRequest;
use App\Http\Requests\UserProfileLink\StoreRequest;
use App\Http\Requests\UserProfileLink\UpdateRequest;
use App\Http\Resources\UserProfileLinkResource;
use App\Http\Resources\UserProfileLinkResourceCollection;
use App\Repositories\Contracts\UserProfileLinkRepository;
use Illuminate\Auth\Access\AuthorizationException;

class UserProfileLinkController extends Controller
{
    /**
     * @var UserProfileLinkRepository
     */
    protected $userProfileLinkRepository;

    /**
     * UserProfileLinkController constructor.
     * @param UserProfileLinkRepository $userProfileLinkRepository
     */
    public function __construct(UserProfileLinkRepository $userProfileLinkRepository)
    {
        $this->userProfileLinkRepository = $userProfileLinkRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserProfileLinkResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [UserProfilePost::class, $request->get('userId', null)]);

        $userProfileLinks = $this->userProfileLinkRepository->findBy($request->all());

        return new UserProfileLinkResourceCollection($userProfileLinks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return UserProfileLinkResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [UserProfilePost::class, $request->get('userId')]);

        $userProfileLink = $this->userProfileLinkRepository->save($request->all());

        return new UserProfileLinkResource($userProfileLink);
    }

    /**
     * Display the specified resource.
     *
     * @param UserProfileLink $userProfileLink
     * @return UserProfileLinkResource
     * @throws AuthorizationException
     */
    public function show(UserProfileLink $userProfileLink)
    {
        $this->authorize('show', $userProfileLink);

        return new UserProfileLinkResource($userProfileLink);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserProfileLink $userProfileLink
     * @return UserProfileLinkResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, UserProfileLink $userProfileLink)
    {
        $this->authorize('update', $userProfileLink);

        $userProfileLink = $this->userProfileLinkRepository->update($userProfileLink,$request->all());

        return new UserProfileLinkResource($userProfileLink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserProfileLink $userProfileLink
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(UserProfileLink $userProfileLink)
    {
        $this->authorize('destroy', $userProfileLink);

        $this->userProfileLinkRepository->delete($userProfileLink);

        return response()->json(null,204);
    }
}
