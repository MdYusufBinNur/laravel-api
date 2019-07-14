<?php

namespace App\Http\Controllers;

use App\DbModels\EnterpriseUserProperty;
use App\Http\Requests\EnterpriseUserProperty\IndexRequest;
use App\Http\Requests\EnterpriseUserProperty\StoreRequest;
use App\Http\Requests\EnterpriseUserProperty\UpdateRequest;
use App\Http\Resources\EnterpriseUserPropertyResource;
use App\Http\Resources\EnterpriseUserPropertyResourceCollection;
use App\Repositories\Contracts\EnterpriseUserPropertyRepository;
use Illuminate\Http\Request;

class EnterpriseUserPropertyController extends Controller
{
    /**
     * @var EnterpriseUserPropertyRepository
     */
    protected $enterpriseUserPropertyRepository;

    /**
     * EnterpriseUserPropertyController constructor.
     * @param EnterpriseUserPropertyRepository $enterpriseUserPropertyRepository
     */
    public function __construct(EnterpriseUserPropertyRepository $enterpriseUserPropertyRepository)
    {
        $this->enterpriseUserPropertyRepository = $enterpriseUserPropertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return EnterpriseUserPropertyResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $enterpriseUserProperties = $this->enterpriseUserPropertyRepository->findBy($request->all());

        return new EnterpriseUserPropertyResourceCollection($enterpriseUserProperties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return EnterpriseUserPropertyResource
     */
    public function store(StoreRequest $request)
    {
        $enterpriseUserProperty = $this->enterpriseUserPropertyRepository->save($request->all());

        return new EnterpriseUserPropertyResource($enterpriseUserProperty);
    }

    /**
     * Display the specified resource.
     *
     * @param EnterpriseUserProperty $enterpriseUserProperty
     * @return EnterpriseUserPropertyResource
     */
    public function show(EnterpriseUserProperty $enterpriseUserProperty)
    {
        return new EnterpriseUserPropertyResource($enterpriseUserProperty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param EnterpriseUserProperty $enterpriseUserProperty
     * @return EnterpriseUserPropertyResource
     */
    public function update(UpdateRequest $request, EnterpriseUserProperty $enterpriseUserProperty)
    {
        $enterpriseUserProperty = $this->enterpriseUserPropertyRepository->update($enterpriseUserProperty, $request->all());

        return new EnterpriseUserPropertyResource($enterpriseUserProperty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EnterpriseUserProperty $enterpriseUserProperty
     * @return null
     */
    public function destroy(EnterpriseUserProperty $enterpriseUserProperty)
    {
        $this->enterpriseUserPropertyRepository->delete($enterpriseUserProperty);

        return response()->json(null,204);
    }
}
