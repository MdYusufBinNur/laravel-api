<?php

namespace App\Http\Controllers;

use App\DbModels\Post;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;
use App\Repositories\Contracts\PostRepository;

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
     */
    public function index(IndexRequest $request)
    {
        $posts = $this->postRepository->findBy($request->all());

        return new PostResourceCollection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return PostResource
     */
    public function store(StoreRequest $request)
    {
        $post = $this->postRepository->save($request->all());

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $post = $this->postRepository->update($post, $request->all());

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post)
    {
        $this->postRepository->delete($post);

        return response()->json(null,204);
    }
}
