<?php

namespace App\Http\Controllers;

use App\DbModels\PropertySocialMedia;
use App\Http\Requests\PropertySocialMedia\IndexRequest;
use App\Http\Requests\PropertySocialMedia\StoreRequest;
use App\Http\Requests\PropertySocialMedia\UpdateRequest;
use App\Http\Resources\PropertySocialMediaResource;
use App\Http\Resources\PropertySocialMediaResourceCollection;
use App\Repositories\Contracts\PropertySocialMediaRepository;

class PropertySocialMediaController extends Controller
{
    /**
     * @var PropertySocialMediaRepository
     */
    protected $propertySocialMediaRepository;

    /**
     * PropertySocialMediaController constructor.
     * @param PropertySocialMediaRepository $propertySocialMediaRepository
     */
    public function __construct(PropertySocialMediaRepository $propertySocialMediaRepository)
    {
        $this->propertySocialMediaRepository = $propertySocialMediaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PropertySocialMediaResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $propertySocialMedias = $this->propertySocialMediaRepository->findBy($request->all());

        return new PropertySocialMediaResourceCollection($propertySocialMedias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return PropertySocialMediaResource
     */
    public function store(StoreRequest $request)
    {
        $propertySocialMedia = $this->propertySocialMediaRepository->save($request->all());

        return new PropertySocialMediaResource($propertySocialMedia);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertySocialMedia $propertySocialMedia
     * @return PropertySocialMediaResource
     */
    public function show(PropertySocialMedia $propertySocialMedia)
    {
        return new PropertySocialMediaResource($propertySocialMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertySocialMedia $propertySocialMedia
     * @return PropertySocialMediaResource
     */
    public function update(UpdateRequest $request, PropertySocialMedia $propertySocialMedia)
    {
        $propertySocialMedia = $this->propertySocialMediaRepository->update($propertySocialMedia, $request->all());

        return new PropertySocialMediaResource($propertySocialMedia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertySocialMedia $propertySocialMedia
     * @return void
     */
    public function destroy(PropertySocialMedia $propertySocialMedia)
    {
        $this->propertySocialMediaRepository->delete($propertySocialMedia);

        return response()->json(null, 204);
    }
}
