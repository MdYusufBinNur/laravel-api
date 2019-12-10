<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyLink;
use App\Http\Requests\PropertyLink\IndexRequest;
use App\Http\Requests\PropertyLink\StoreRequest;
use App\Http\Requests\PropertyLink\UpdateRequest;
use App\Http\Resources\PropertyLinkResource;
use App\Http\Resources\PropertyLinkResourceCollection;
use App\Repositories\Contracts\PropertyLinkRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PropertyLinkController extends Controller
{
    /**
     * @var PropertyLinkRepository
     */
    protected $propertyLinkRepository;

    /**
     * PropertyLinkController constructor.
     * @param PropertyLinkRepository $propertyLinkRepository
     */public function __construct(PropertyLinkRepository $propertyLinkRepository)
    {
        $this->propertyLinkRepository = $propertyLinkRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PropertyLinkResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PropertyLink::class, $request->get('propertyId')]);

        $propertyLinks = $this->propertyLinkRepository->findBy($request->all());

        return new PropertyLinkResourceCollection($propertyLinks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PropertyLinkResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PropertyLink::class, $request->get('propertyId')]);

        $propertyLink = $this->propertyLinkRepository->save($request->all());

        return new PropertyLinkResource($propertyLink);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyLink $propertyLink
     * @return PropertyLinkResource
     * @throws AuthorizationException
     */
    public function show(PropertyLink $propertyLink)
    {
        $this->authorize('show', $propertyLink);

        return new PropertyLinkResource($propertyLink);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyLink $propertyLink
     * @return PropertyLinkResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PropertyLink $propertyLink)
    {
        $this->authorize('update', $propertyLink);

        $propertyLink = $this->propertyLinkRepository->update($propertyLink,$request->all());

        return new PropertyLinkResource($propertyLink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyLink $propertyLink
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(PropertyLink $propertyLink)
    {
        $this->authorize('destroy', $propertyLink);

        $this->propertyLinkRepository->delete($propertyLink);

        return response()->json(null, 204);
    }
}
