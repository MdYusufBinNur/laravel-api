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
     * @return PropertySocialMediaResourceCollection
     */
    public function store(StoreRequest $request)
    {
        $propertySocialMedia = $this->propertySocialMediaRepository->savePropertySocialMedia($request->all());

        return new PropertySocialMediaResourceCollection($propertySocialMedia);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return PropertySocialMediaResource
     */
    public function show($id)
    {
        $propertySocialMedia = $this->propertySocialMediaRepository->findOne($id) ?? abort(404);

        return new PropertySocialMediaResource($propertySocialMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return PropertySocialMediaResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $getPropertySocialMedia = $this->propertySocialMediaRepository->findOne($id) ?? abort(404);

        $propertySocialMedia = $this->propertySocialMediaRepository->update($getPropertySocialMedia, $request->all());

        return new PropertySocialMediaResource($propertySocialMedia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $getPropertySocialMedia = $this->propertySocialMediaRepository->findOne($id) ?? abort(404);

        $this->propertySocialMediaRepository->delete($getPropertySocialMedia);

        return response()->json(null, 204);
    }
}
