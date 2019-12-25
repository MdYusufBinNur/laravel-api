<?php

namespace App\Http\Controllers;

use App\DbModels\EnterpriseUser;
use App\Http\Requests\EnterpriseUser\DestroyRequest;
use App\Http\Requests\EnterpriseUser\IndexRequest;
use App\Http\Requests\EnterpriseUser\StoreRequest;
use App\Http\Requests\EnterpriseUser\UpdateRequest;
use App\Http\Resources\EnterpriseUserResource;
use App\Http\Resources\EnterpriseUserResourceCollection;
use App\Repositories\Contracts\EnterpriseUserRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [EnterpriseUser::class, $request->get('companyId')]);

        $enterpriseUsers = $this->enterpriseUserRepository->findBy($request->all());

        return new EnterpriseUserResourceCollection($enterpriseUsers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return EnterpriseUserResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [EnterpriseUser::class, $request->get('companyId')]);

        $enterpriseUser = $this->enterpriseUserRepository->save($request->all());

        return new EnterpriseUserResource($enterpriseUser);
    }

    /**
     * Display the specified resource.
     *
     * @param EnterpriseUser $enterpriseUser
     * @return EnterpriseUserResource
     * @throws AuthorizationException
     */
    public function show(EnterpriseUser $enterpriseUser)
    {
        $this->authorize('show', $enterpriseUser);

        return new EnterpriseUserResource($enterpriseUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param EnterpriseUser $enterpriseUser
     * @return EnterpriseUserResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, EnterpriseUser $enterpriseUser)
    {
        $this->authorize('update', $enterpriseUser);

        $enterpriseUser = $this->enterpriseUserRepository->updateEnterpriseUser($enterpriseUser, $request->all());

        return new EnterpriseUserResource($enterpriseUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param EnterpriseUser $enterpriseUser
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(DestroyRequest $request, EnterpriseUser $enterpriseUser)
    {
        $this->authorize('destroy', $enterpriseUser);

        $this->enterpriseUserRepository->deleteEnterpriseUser($enterpriseUser,$request->all());

        return response()->json(null, 204);
    }
}
