<?php

namespace App\Http\Controllers;

use App\DbModels\Company;
use App\Http\Requests\Company\IndexRequest;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyResourceCollection;
use App\Repositories\Contracts\CompanyRepository;

class CompanyController extends Controller
{
    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * CompanyController constructor.
     *
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CompanyResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $companies = $this->companyRepository->findBy($request->all());
        return new CompanyResourceCollection($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return CompanyResource
     */
    public function store(StoreRequest $request)
    {
        $company = $this->companyRepository->save($request->all());
        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return CompanyResource
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  Company $company
     * @return CompanyResource
     */
    public function update(UpdateRequest $request, Company $company)
    {
        $company = $this->companyRepository->update($company, $request->all());

        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return null;
     */
    public function destroy(Company $company)
    {
        $this->companyRepository->delete($company);

        return response()->json(null, 204);
    }
}
