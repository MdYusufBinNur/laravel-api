<?php

namespace App\Http\Controllers;

use App\DbModels\PropertySocialMedia;
use App\Http\Requests\PropertySocialMedia\IndexRequest;
use App\Http\Requests\PropertySocialMedia\StoreRequest;
use App\Http\Requests\PropertySocialMedia\UpdateRequest;
use App\Http\Resources\PropertySocialMediaResource;
use App\Http\Resources\PropertySocialMediaResourceCollection;
use App\Repositories\Contracts\PropertySocialMediaRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', PropertySocialMedia::class);

        $propertySocialMedias = $this->propertySocialMediaRepository->findBy($request->all());

        return new PropertySocialMediaResourceCollection($propertySocialMedias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest  $request
     * @return PropertySocialMediaResourceCollection
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PropertySocialMedia::class, $request->get('propertyId')]);

        $propertySocialMedia = $this->propertySocialMediaRepository->savePropertySocialMedia($request->all());

        return new PropertySocialMediaResourceCollection($propertySocialMedia);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return PropertySocialMediaResource
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $propertySocialMedia = $this->propertySocialMediaRepository->findOne($id) ?? abort(404);

        $this->authorize('show', $propertySocialMedia);

        return new PropertySocialMediaResource($propertySocialMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return PropertySocialMediaResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, $id)
    {
        $propertySocialMedia = $this->propertySocialMediaRepository->findOne($id) ?? abort(404);

        $this->authorize('update', $propertySocialMedia);


        $propertySocialMedia = $this->propertySocialMediaRepository->update($propertySocialMedia, $request->all());

        return new PropertySocialMediaResource($propertySocialMedia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     * @throws AuthorizationException
     */
    public function destroy($id)
    {
        $propertySocialMedia = $this->propertySocialMediaRepository->findOne($id) ?? abort(404);

        $this->authorize('destroy', $propertySocialMedia);

        $this->propertySocialMediaRepository->delete($propertySocialMedia);

        return response()->json(null, 204);
    }
}
