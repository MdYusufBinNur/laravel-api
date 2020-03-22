<?php

namespace App\Http\Controllers;

use App\DbModels\Post;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\LikedUserRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;
use App\Http\Resources\UserResourceCollection;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PostController extends Controller
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Post::class, $request->input('propertyId')]);

        $posts = $this->postRepository->findBy($request->all());

        return new PostResourceCollection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return PostResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Post::class, $request->input('propertyId')]);

        $post = $this->postRepository->save($request->all());

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
     * @throws AuthorizationException
     */
    public function show(Post $post)
    {
        $this->authorize('show', $post);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Post $post
     * @return PostResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post = $this->postRepository->update($post, $request->all());

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);

        $this->postRepository->delete($post);

        return response()->json(null,204);
    }

    /**
     * Display a listing of liked users.
     *
     * @param LikedUserRequest $request
     * @return UserResourceCollection
     * @throws AuthorizationException
     */
    public function likedUsers(LikedUserRequest $request)
    {
        $this->authorize('list', [Post::class, $request->input('propertyId')]);

        $users = $this->postRepository->likedUsersByPostId($request->get('postId'));

        return new UserResourceCollection($users);
    }
}
