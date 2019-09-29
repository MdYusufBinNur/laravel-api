<?php

namespace App\Http\Controllers;

use App\DbModels\EnterpriseUser;
use App\Http\Requests\EnterpriseUser\IndexRequest;
use App\Http\Requests\EnterpriseUser\StoreRequest;
use App\Http\Requests\EnterpriseUser\UpdateRequest;
use App\Http\Resources\EnterpriseUserResource;
use App\Http\Resources\EnterpriseUserResourceCollection;
use App\Repositories\Contracts\EnterpriseUserRepository;
use Illuminate\Http\Request;

class EnterpriseUserController extends Controller
{

    /**
     * @var EnterpriseUserRepository
     */
    protected $enterpriseUserRepository;

    /**
     * EnterpriseUserController constructor.
     * @param EnterpriseUserRepository $enterpriseUserRepository
     */
    public function __construct(EnterpriseUserRepository $enterpriseUserRepository)
    {
        $this->enterpriseUserRepository = $enterpriseUserRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return EnterpriseUserResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $enterpriseUsers = $this->enterpriseUserRepository->findBy($request->all());

        return new EnterpriseUserResourceCollection($enterpriseUsers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return EnterpriseUserResource
     */
    public function store(StoreRequest $request)
    {
        $enterpriseUser = $this->enterpriseUserRepository->save($request->all());

        return new EnterpriseUserResource($enterpriseUser);
    }

    /**
     * Display the specified resource.
     *
     * @param EnterpriseUser $enterpriseUser
     * @return EnterpriseUserResource
     */
    public function show(EnterpriseUser $enterpriseUser)
    {
        return new EnterpriseUserResource($enterpriseUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param EnterpriseUser $enterpriseUser
     * @return EnterpriseUserResource
     */
    public function update(UpdateRequest $request, EnterpriseUser $enterpriseUser)
    {
        $enterpriseUser = $this->enterpriseUserRepository->updateEnterpriseUser($enterpriseUser, $request->all());

        return new EnterpriseUserResource($enterpriseUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EnterpriseUser $enterpriseUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnterpriseUser $enterpriseUser)
    {
        $this->enterpriseUserRepository->delete($enterpriseUser);

        return response()->json(null, 204);
    }
}
