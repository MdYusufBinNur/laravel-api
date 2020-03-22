<?php

namespace App\Http\Controllers;

use App\DbModels\ServiceRequestCategory;
use App\Http\Requests\ServiceRequestCategory\IndexRequest;
use App\Http\Requests\ServiceRequestCategory\StoreRequest;
use App\Http\Requests\ServiceRequestCategory\UpdateRequest;
use App\Http\Resources\ServiceRequestCategoryResource;
use App\Http\Resources\ServiceRequestCategoryResourceCollection;
use App\Repositories\Contracts\ServiceRequestCategoryRepository;
use Illuminate\Auth\Access\AuthorizationException;

class ServiceRequestCategoryController extends Controller
{
    /**
     * @var ServiceRequestCategoryRepository
     */
    protected $serviceRequestCategoryRepository;

    /**
     * ServiceRequestCategoryController constructor.
     * @param ServiceRequestCategoryRepository $serviceRequestCategoryRepository
     */
    public function __construct(ServiceRequestCategoryRepository $serviceRequestCategoryRepository)
    {
        $this->serviceRequestCategoryRepository = $serviceRequestCategoryRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ServiceRequestCategoryResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [ServiceRequestCategory::class, $request->input('propertyId')]);

        $serviceRequestCategories = $this->serviceRequestCategoryRepository->findBy($request->all());

        return new ServiceRequestCategoryResourceCollection($serviceRequestCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ServiceRequestCategoryResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [ServiceRequestCategory::class, $request->input('propertyId')]);

        $serviceRequestCategory = $this->serviceRequestCategoryRepository->save($request->all());

        return new ServiceRequestCategoryResource($serviceRequestCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequestCategory $serviceRequestCategory
     * @return ServiceRequestCategoryResource
     * @throws AuthorizationException
     */
    public function show(ServiceRequestCategory $serviceRequestCategory)
    {
        $this->authorize('show', $serviceRequestCategory);

        return new ServiceRequestCategoryResource($serviceRequestCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ServiceRequestCategory $serviceRequestCategory
     * @return ServiceRequestCategoryResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, ServiceRequestCategory $serviceRequestCategory)
    {
        $this->authorize('update', $serviceRequestCategory);

        $serviceRequestCategory = $this->serviceRequestCategoryRepository->update($serviceRequestCategory,$request->all());

        return new ServiceRequestCategoryResource($serviceRequestCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequestCategory $serviceRequestCategory
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(ServiceRequestCategory $serviceRequestCategory)
    {
        $this->authorize('destroy', $serviceRequestCategory);

        $this->serviceRequestCategoryRepository->delete($serviceRequestCategory);
    }
}
