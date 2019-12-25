<?php

namespace App\Http\Controllers;

use App\DbModels\PostApprovalArchive;
use App\Http\Requests\PostApprovalArchive\IndexRequest;
use App\Http\Resources\PostApprovalArchiveResource;
use App\Http\Resources\PostApprovalArchiveResourceCollection;
use App\Repositories\Contracts\PostApprovalArchiveRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PostApprovalArchive::class, $request->get('propertyId')]);

        $postApprovalArchives = $this->postApprovalArchiveRepository->findBy($request->all());

        return new PostApprovalArchiveResourceCollection($postApprovalArchives);
    }

    /**
     * Display the specified resource.
     *
     * @param PostApprovalArchive $postApprovalArchive
     * @return PostApprovalArchiveResource
     * @throws AuthorizationException
     */
    public function show(PostApprovalArchive $postApprovalArchive)
    {
        $this->authorize('show', $postApprovalArchive);

        return new PostApprovalArchiveResource($postApprovalArchive);
    }
}
