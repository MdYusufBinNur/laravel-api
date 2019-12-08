<?php

namespace App\Http\Controllers;

use App\DbModels\EnterpriseUser;
use App\DbModels\EnterpriseUserProperty;
use App\Http\Requests\EnterpriseUserProperty\IndexRequest;
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
        $this->authorize('list', EnterpriseUser::class);

        $enterpriseUserProperties = $this->enterpriseUserPropertyRepository->findBy($request->all());

        return new EnterpriseUserPropertyResourceCollection($enterpriseUserProperties);
    }

    /**
     * Display the specified resource.
     *
     * @param EnterpriseUserProperty $enterpriseUserProperty
     * @return EnterpriseUserPropertyResource
     */
    public function show(EnterpriseUserProperty $enterpriseUserProperty)
    {
        $this->authorize('show', $enterpriseUserProperty);

        return new EnterpriseUserPropertyResource($enterpriseUserProperty);
    }
}
