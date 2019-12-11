<?php

namespace App\Http\Controllers;

use App\DbModels\PostComment;
use App\Http\Requests\PostComment\IndexRequest;
use App\Http\Requests\PostComment\StoreRequest;
use App\Http\Requests\PostComment\UpdateRequest;
use App\Http\Resources\PostCommentResource;
use App\Http\Resources\PostCommentResourceCollection;
use App\Repositories\Contracts\PostCommentRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PostCommentController extends Controller
{
    /**
     * @var PostCommentRepository
     */
    protected $postCommentRepository;

    /**
     * PostCommentController constructor.
     * @param PostCommentRepository $postCommentRepository
     */
    public function __construct(PostCommentRepository $postCommentRepository)
    {
        $this->postCommentRepository = $postCommentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostCommentResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PostComment::class, $request->get('postId')]);

        $postComments = $this->postCommentRepository->findBy($request->all());

        return new PostCommentResourceCollection($postComments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return PostCommentResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PostComment::class, $request->get('postId')]);

        $postComment = $this->postCommentRepository->save($request->all());

        return new PostCommentResource($postComment);
    }

    /**
     * Display the specified resource.
     *
     * @param PostComment $postComment
     * @return PostCommentResource
     * @throws AuthorizationException
     */
    public function show(PostComment $postComment)
    {
        $this->authorize('show', $postComment);

        return new PostCommentResource($postComment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostComment $postComment
     * @return PostCommentResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PostComment $postComment)
    {
        $this->authorize('update', $postComment);

        $postComment = $this->postCommentRepository->update($postComment, $request->all());

        return new PostCommentResource($postComment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostComment $postComment
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PostComment $postComment)
    {
        $this->authorize('destroy', $postComment);

        $this->postCommentRepository->delete($postComment);

        return response()->json(null,204);
    }
}
