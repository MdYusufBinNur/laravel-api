<?php

namespace App\Http\Controllers;

use App\DbModels\PostApprovalArchive;
use App\Http\Requests\PostApprovalArchive\IndexRequest;
use App\Http\Requests\PostApprovalArchive\StoreRequest;
use App\Http\Requests\PostApprovalArchive\UpdateRequest;
use App\Http\Resources\PostApprovalArchiveResource;
use App\Http\Resources\PostApprovalArchiveResourceCollection;
use App\Repositories\Contracts\PostApprovalArchiveRepository;
use Illuminate\Http\Request;

class PostApprovalArchiveController extends Controller
{
    /**
     * @var PostApprovalArchiveRepository
     */
    protected $postApprovalArchiveRepository;

    /**
     * PostApprovalArchiveController constructor.
     * @param PostApprovalArchiveRepository $postApprovalArchiveRepository
     */
    public function __construct(PostApprovalArchiveRepository $postApprovalArchiveRepository)
    {
        $this->postApprovalArchiveRepository = $postApprovalArchiveRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostApprovalArchiveResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $postApprovalArchives = $this->postApprovalArchiveRepository->findBy($request->all());

        return new PostApprovalArchiveResourceCollection($postApprovalArchives);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return PostApprovalArchiveResource
     */
    public function store(StoreRequest $request)
    {
        $postApprovalArchive = $this->postApprovalArchiveRepository->save($request->all());

        return new PostApprovalArchiveResource($postApprovalArchive);
    }

    /**
     * Display the specified resource.
     *
     * @param PostApprovalArchive $postApprovalArchive
     * @return PostApprovalArchiveResource
     */
    public function show(PostApprovalArchive $postApprovalArchive)
    {
        return new PostApprovalArchiveResource($postApprovalArchive);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostApprovalArchive $postApprovalArchive
     * @return PostApprovalArchiveResource
     */
    public function update(UpdateRequest $request, PostApprovalArchive $postApprovalArchive)
    {
        $postApprovalArchive = $this->postApprovalArchiveRepository->update($postApprovalArchive,$request->all());

        return new PostApprovalArchiveResource($postApprovalArchive);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostApprovalArchive $postApprovalArchive
     * @return void
     */
    public function destroy(PostApprovalArchive $postApprovalArchive)
    {
        $this->postApprovalArchiveRepository->delete($postApprovalArchive);

        return response()->json(null, 204);
    }
}
