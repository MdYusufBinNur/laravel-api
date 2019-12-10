<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyLinkCategory;
use App\Http\Requests\PropertyLinkCategory\IndexRequest;
use App\Http\Requests\PropertyLinkCategory\StoreRequest;
use App\Http\Requests\PropertyLinkCategory\UpdateRequest;
use App\Http\Resources\PropertyLinkCategoryResource;
use App\Http\Resources\PropertyLinkCategoryResourceCollection;
use App\Repositories\Contracts\PropertyLinkCategoryRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PropertyLinkCategoryController extends Controller
{
    /**
     * @var PropertyLinkCategoryRepository
     */
    protected $propertyLinkCategoryRepository;

    /**
     * PropertyLinkCategoryController constructor.
     * @param PropertyLinkCategoryRepository $propertyLinkCategoryRepository
     */
    public function __construct(PropertyLinkCategoryRepository $propertyLinkCategoryRepository)
    {
        $this->propertyLinkCategoryRepository = $propertyLinkCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PropertyLinkCategoryResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PropertyLinkCategory::class, $request->get('propertyId')]);

        $propertyLinkCategories = $this->propertyLinkCategoryRepository->findBy($request->all());

        return new PropertyLinkCategoryResourceCollection($propertyLinkCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PropertyLinkCategoryResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PropertyLinkCategory::class, $request->get('propertyId')]);

        $propertyLinkCategory = $this->propertyLinkCategoryRepository->save($request->all());

        return new PropertyLinkCategoryResource($propertyLinkCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyLinkCategory $propertyLinkCategory
     * @return PropertyLinkCategoryResource
     * @throws AuthorizationException
     */
    public function show(PropertyLinkCategory $propertyLinkCategory)
    {
        $this->authorize('show', $propertyLinkCategory);

        return new PropertyLinkCategoryResource($propertyLinkCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyLinkCategory $propertyLinkCategory
     * @return PropertyLinkCategoryResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PropertyLinkCategory $propertyLinkCategory)
    {
        $this->authorize('update', $propertyLinkCategory);

        $propertyLinkCategory = $this->propertyLinkCategoryRepository->update($propertyLinkCategory, $request->all());

        return new PropertyLinkCategoryResource($propertyLinkCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyLinkCategory $propertyLinkCategory
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(PropertyLinkCategory $propertyLinkCategory)
    {
        $this->authorize('destroy', $propertyLinkCategory);

        $this->propertyLinkCategoryRepository->delete($propertyLinkCategory);

        return response()->json(null, 204);
    }
}
