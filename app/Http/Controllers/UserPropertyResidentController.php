<?php

namespace App\Http\Controllers;

use App\DbModels\UserPropertyResident;
use App\Http\Requests\UserPropertyResident\IndexRequest;
use App\Http\Requests\UserPropertyResident\StoreRequest;
use App\Http\Requests\UserPropertyResident\UpdateRequest;
use App\Http\Resources\UserPropertyResidentResource;
use App\Http\Resources\UserPropertyResidentResourceCollection;
use App\Repositories\Contracts\UserPropertyResidentRepository;
use Illuminate\Http\Request;

class UserPropertyResidentController extends Controller
{
    /**
     * @var UserPropertyResidentRepository
     */
    protected $userPropertyResidentRepository;

    /**
     * UserPropertyResidentController constructor.
     * @param UserPropertyResidentRepository $userPropertyResidentRepository
     */
    public function __construct(UserPropertyResidentRepository $userPropertyResidentRepository)
    {
        $this->userPropertyResidentRepository = $userPropertyResidentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return UserPropertyResidentResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $userPropertyResidents = $this->userPropertyResidentRepository->findBy($request->all());

        return new UserPropertyResidentResourceCollection($userPropertyResidents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserPropertyResidentResource
     */
    public function store(StoreRequest $request)
    {
        $userPropertyResident = $this->userPropertyResidentRepository->save($request->all());

        return new UserPropertyResidentResource($userPropertyResident);
    }

    /**
     * Display the specified resource.
     *
     * @param UserPropertyResident $userPropertyResident
     * @return UserPropertyResidentResource
     */
    public function show(UserPropertyResident $userPropertyResident)
    {
        return new UserPropertyResidentResource($userPropertyResident);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserPropertyResident $userPropertyResident
     * @return UserPropertyResidentResource
     */
    public function update(UpdateRequest $request, UserPropertyResident $userPropertyResident)
    {
        $userPropertyResident = $this->userPropertyResidentRepository->update($userPropertyResident, $request->all());

        return new UserPropertyResidentResource($userPropertyResident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserPropertyResident $userPropertyResident
     * @return void
     */
    public function destroy(UserPropertyResident $userPropertyResident)
    {
        $this->userPropertyResidentRepository->delete($userPropertyResident);

        return response()->json(null, 204);
    }
}
