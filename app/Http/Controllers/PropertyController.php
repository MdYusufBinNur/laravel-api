<?php

namespace App\Http\Controllers;

use App\Http\Requests\Property\IndexRequest;
use App\Http\Requests\Property\StoreRequest;
use App\Http\Requests\Property\UpdateRequest;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyResourceCollection;
use App\DbModels\Property;
use App\Repositories\Contracts\PropertyRepository;

class PropertyController extends Controller
{
    /**
     * @var PropertyRepository
     */
    protected $propertyRepository;

    /**
     * PropertyController constructor.
     *
     * @param PropertyRepository $propertyRepository
     */
    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PropertyResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $properties = $this->propertyRepository->findBy($request->all());
        return new PropertyResourceCollection($properties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return PropertyResource
     */
    public function store(StoreRequest $request)
    {
        $property = $this->propertyRepository->save($request->all());
        return new PropertyResource($property);
    }

    /**
     * Display the specified resource.
     *
     * @param Property $property
     * @return PropertyResource
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  Property $property
     * @return PropertyResource
     */
    public function update(UpdateRequest $request, Property $property)
    {
        $property = $this->propertyRepository->update($property, $request->all());

        return new PropertyResource($property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @return null;
     */
    public function destroy(Property $property)
    {
        $this->propertyRepository->delete($property);

        return response()->json(null, 204);
    }
}
