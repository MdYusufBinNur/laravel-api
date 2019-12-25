<?php

namespace App\Http\Controllers;

use App\Http\Requests\Property\IndexRequest;
use App\Http\Requests\Property\PropertyByHostRequest;
use App\Http\Requests\Property\StoreRequest;
use App\Http\Requests\Property\UpdateRequest;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyResourceCollection;
use App\DbModels\Property;
use App\Repositories\Contracts\PropertyRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

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
     * list all properties
     *
     * @param IndexRequest $request
     * @return PropertyResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Property::class, $request->get('companyId', null)]);

        $properties = $this->propertyRepository->findBy($request->all());
        return new PropertyResourceCollection($properties);
    }

    /**
     * create a property
     *
     * @param  StoreRequest $request
     * @return PropertyResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Property::class, $request->get('companyId', null)]);

        $property = $this->propertyRepository->save($request->all());
        return new PropertyResource($property);
    }

    /**
     * get a company
     *
     * @param Property $property
     * @return PropertyResource
     * @throws AuthorizationException
     */
    public function show(Property $property)
    {
        $this->authorize('show', $property);

        return new PropertyResource($property);
    }

    /**
     * update a company
     *
     * @param  UpdateRequest $request
     * @param  Property $property
     * @return PropertyResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Property $property)
    {
        $this->authorize('update', [$property, $request->get('companyId', null)]);

        $property = $this->propertyRepository->update($property, $request->all());

        return new PropertyResource($property);
    }

    /**
     * remove a company
     *
     * @param Property $property
     * @return null
     * @throws AuthorizationException
     */
    public function destroy(Property $property)
    {
        $this->authorize('destroy', $property);

        $this->propertyRepository->delete($property);

        return response()->json(null, 204);
    }

    /**
     * find a property by host
     *
     * @param PropertyByHostRequest $request
     * @return PropertyResource
     */
    public function propertyByHost(PropertyByHostRequest $request)
    {
        $property = $this->propertyRepository->findByHost($request->get('host'));

        if (!$property instanceof Property) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        return new PropertyResource($property);
    }

}
