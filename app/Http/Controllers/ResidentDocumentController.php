<?php

namespace App\Http\Controllers;

use App\DbModels\ResidentDocument;
use App\Http\Requests\ResidentDocument\IndexRequest;
use App\Http\Requests\ResidentDocument\StoreRequest;
use App\Http\Requests\ResidentDocument\UpdateRequest;
use App\Http\Resources\ResidentDocumentResource;
use App\Http\Resources\ResidentDocumentResourceCollection;
use App\Repositories\Contracts\ResidentDocumentRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ResidentDocumentController extends Controller
{
    /**
     * @var ResidentDocumentRepository
     */
    protected $residentDocumentRepository;

    /**
     * ResidentDocumentController constructor.
     * @param ResidentDocumentRepository $residentDocumentRepository
     */
    public function __construct(ResidentDocumentRepository $residentDocumentRepository)
    {
        $this->residentDocumentRepository = $residentDocumentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ResidentDocumentResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ResidentDocument::class, $request->get('residentId')]);

        $residentDocuments = $this->residentDocumentRepository->findBy($request->all());

        return new ResidentDocumentResourceCollection($residentDocuments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ResidentDocumentResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ResidentDocument::class, $request->get('residentId')]);

        $residentDocument = $this->residentDocumentRepository->save($request->all());

        return new ResidentDocumentResource($residentDocument);
    }

    /**
     * Display the specified resource.
     *
     * @param ResidentDocument $residentDocument
     * @return ResidentDocumentResource
     * @throws AuthorizationException
     */
    public function show(ResidentDocument $residentDocument)
    {
        $this->authorize('show', $residentDocument);

        return new ResidentDocumentResource($residentDocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ResidentDocument $residentDocument
     * @return ResidentDocumentResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ResidentDocument $residentDocument)
    {
        $this->authorize('update', $residentDocument);

        $residentDocument = $this->residentDocumentRepository->update($residentDocument, $request->all());

        return new ResidentDocumentResource($residentDocument);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentDocument $residentDocument
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ResidentDocument $residentDocument)
    {
        $this->authorize('destroy', $residentDocument);

        $this->residentDocumentRepository->delete($residentDocument);

        return response()->json(null, 204);
    }
}