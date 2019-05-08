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
     * list all companies
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
     * create a company
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
     * get a company
     *
     * @param Company $company
     * @return CompanyResource
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * update a company
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
     * remove a company
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
