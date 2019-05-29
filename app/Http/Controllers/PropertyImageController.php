<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyImage;
use App\Http\Requests\PropertyImage\IndexRequest;
use App\Http\Requests\PropertyImage\StoreRequest;
use App\Http\Requests\PropertyImage\UpdateRequest;
use App\Http\Resources\PropertyImageResource;
use App\Http\Resources\PropertyImageResourceCollection;
use App\Repositories\Contracts\PropertyImageRepository;
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
     */
    public function index(IndexRequest $request)
    {
        $propertyImages = $this->propertyImageRepository->findBy($request->all());

        return new PropertyImageResourceCollection($propertyImages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PropertyImageResource
     */
    public function store(StoreRequest $request)
    {
        $propertyImage = $this->propertyImageRepository->save($request->all());

        return new PropertyImageResource($propertyImage);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyImage $propertyImage
     * @return PropertyImageResource
     */
    public function show(PropertyImage $propertyImage)
    {
        return new PropertyImageResource($propertyImage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyImage $propertyImage
     * @return PropertyImageResource
     */
    public function update(UpdateRequest $request, PropertyImage $propertyImage)
    {
        $propertyImage = $this->propertyImageRepository->update($propertyImage,$request->all());

        return new PropertyImageResource($propertyImage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyImage $propertyImage
     * @return void
     */
    public function destroy(PropertyImage $propertyImage)
    {
        $this->propertyImageRepository->delete($propertyImage);

        return response()->json(null,204);
    }
}
