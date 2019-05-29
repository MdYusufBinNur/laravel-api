<?php

namespace App\Http\Controllers;

use App\DbModels\ServiceRequestCategory;
use App\Http\Requests\ServiceRequestCategory\IndexRequest;
use App\Http\Requests\ServiceRequestCategory\StoreRequest;
use App\Http\Requests\ServiceRequestCategory\UpdateRequest;
use App\Http\Resources\ServiceRequestCategoryResource;
use App\Http\Resources\ServiceRequestCategoryResourceCollection;
use App\Repositories\Contracts\ServiceRequestCategoryRepository;

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
     */
    public function index(IndexRequest $request)
    {
        $serviceRequestCategories = $this->serviceRequestCategoryRepository->findBy($request->all());

        return new ServiceRequestCategoryResourceCollection($serviceRequestCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return ServiceRequestCategoryResource
     */
    public function store(StoreRequest $request)
    {
        $serviceRequestCategory = $this->serviceRequestCategoryRepository->save($request->all());

        return new ServiceRequestCategoryResource($serviceRequestCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequestCategory $serviceRequestCategory
     * @return ServiceRequestCategoryResource
     */
    public function show(ServiceRequestCategory $serviceRequestCategory)
    {
        return new ServiceRequestCategoryResource($serviceRequestCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ServiceRequestCategory $serviceRequestCategory
     * @return ServiceRequestCategoryResource
     */
    public function update(UpdateRequest $request, ServiceRequestCategory $serviceRequestCategory)
    {
        $serviceRequestCategory = $this->serviceRequestCategoryRepository->update($serviceRequestCategory,$request->all());

        return new ServiceRequestCategoryResource($serviceRequestCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequestCategory $serviceRequestCategory
     * @return void
     */
    public function destroy(ServiceRequestCategory $serviceRequestCategory)
    {
        $this->serviceRequestCategoryRepository->delete($serviceRequestCategory);
    }
}
