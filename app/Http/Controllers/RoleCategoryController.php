<?php

namespace App\Http\Controllers;

use App\DbModels\RoleCategory;
use App\Http\Requests\RoleCategory\IndexRequest;
use App\Http\Requests\RoleCategory\StoreRequest;
use App\Http\Requests\RoleCategory\UpdateRequest;
use App\Http\Resources\RoleCategoryResource;
use App\Http\Resources\RoleCategoryResourceCollection;
use App\Repositories\Contracts\RoleCategoryRepository;

class RoleCategoryController extends Controller
{
    /**
     * @var RoleCategoryRepository
     */
    protected $roleCategoryRepository;

    /**
     * RoleCategoryController constructor.
     * @param RoleCategoryRepository $roleCategoryRepository
     */
    public function __construct(RoleCategoryRepository $roleCategoryRepository)
    {
        $this->roleCategoryRepository = $roleCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return RoleCategoryResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $roleCategories = $this->roleCategoryRepository->findBy($request->all());

        return new RoleCategoryResourceCollection($roleCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return RoleCategoryResource
     */
    public function store(StoreRequest $request)
    {
        $roleCategory = $this->roleCategoryRepository->save($request->all());

        return new RoleCategoryResource($roleCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param RoleCategory $roleCategory
     * @return RoleCategoryResource
     */
    public function show(RoleCategory $roleCategory)
    {
        return new RoleCategoryResource($roleCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param RoleCategory $roleCategory
     * @return RoleCategoryResource
     */
    public function update(UpdateRequest $request, RoleCategory $roleCategory)
    {
        $roleCategory = $this->roleCategoryRepository->update($roleCategory, $request->all());

        return new RoleCategoryResource($roleCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RoleCategory $roleCategory
     * @return void
     */
    public function destroy(RoleCategory $roleCategory)
    {
        $this->roleCategoryRepository->delete($roleCategory);

        return response()->json(null, 204);
    }
}
