<?php

namespace App\Http\Controllers;

use App\DbModels\PostComment;
use App\Http\Requests\PostComment\IndexRequest;
use App\Http\Requests\PostComment\StoreRequest;
use App\Http\Requests\PostComment\UpdateRequest;
use App\Http\Resources\PostCommentResource;
use App\Http\Resources\PostCommentResourceCollection;
use App\Repositories\Contracts\PostCommentRepository;
use Illuminate\Http\Request;

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
     */
    public function index(IndexRequest $request)
    {
        $postComments = $this->postCommentRepository->findBy($request->all());

        return new PostCommentResourceCollection($postComments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return PostCommentResource
     */
    public function store(StoreRequest $request)
    {
        $postComment = $this->postCommentRepository->save($request->all());

        return new PostCommentResource($postComment);
    }

    /**
     * Display the specified resource.
     *
     * @param PostComment $postComment
     * @return PostCommentResource
     */
    public function show(PostComment $postComment)
    {
        return new PostCommentResource($postComment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostComment $postComment
     * @return PostCommentResource
     */
    public function update(UpdateRequest $request, PostComment $postComment)
    {
        $postComment = $this->postCommentRepository->update($postComment, $request->all());

        return new PostCommentResource($postComment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostComment $postComment
     * @return void
     */
    public function destroy(PostComment $postComment)
    {
        $this->postCommentRepository->delete($postComment);

        return response()->json(null,204);
    }
}
