<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyImage;
use App\Http\Requests\PropertyImage\IndexRequest;
use App\Http\Requests\PropertyImage\StoreRequest;
use App\Http\Requests\PropertyImage\UpdateRequest;
use App\Http\Resources\PropertyImageResource;
use App\Http\Resources\PropertyImageResourceCollection;
use App\Repositories\Contracts\PropertyImageRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PropertyImageController extends Controller
{
    /**
     * @var PropertyImageRepository
     */
    protected $propertyImageRepository;

    /**
     * PropertyImageController constructor.
     * @param PropertyImageRepository $propertyImageRepository
     */
    public function __construct(PropertyImageRepository $propertyImageRepository)
    {
        $this->propertyImageRepository = $propertyImageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PropertyImageResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', PropertyImage::class);

        $propertyImages = $this->propertyImageRepository->findBy($request->all());

        return new PropertyImageResourceCollection($propertyImages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PropertyImageResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PropertyImage::class, $request->get('propertyId')]);

        $propertyImage = $this->propertyImageRepository->setPropertyImage($request->all());

        return new PropertyImageResource($propertyImage);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyImage $propertyImage
     * @return PropertyImageResource
     * @throws AuthorizationException
     */
    public function show(PropertyImage $propertyImage)
    {
        $this->authorize('show', $propertyImage);

        return new PropertyImageResource($propertyImage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyImage $propertyImage
     * @return PropertyImageResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PropertyImage $propertyImage)
    {
        $this->authorize('update', $propertyImage);

        $propertyImage = $this->propertyImageRepository->update($propertyImage,$request->all());

        return new PropertyImageResource($propertyImage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyImage $propertyImage
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PropertyImage $propertyImage)
    {
        $this->authorize('destroy', $propertyImage);

        $this->propertyImageRepository->delete($propertyImage);

        return response()->json(null,204);
    }
}
