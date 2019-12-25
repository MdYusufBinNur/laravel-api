<?php

namespace App\Http\Controllers;

use App\DbModels\Company;
use App\DbModels\EnterpriseUser;
use App\Http\Requests\Company\IndexRequest;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyResourceCollection;
use App\Repositories\Contracts\CompanyRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', Company::class);

        $companies = $this->companyRepository->findBy($request->all());
        return new CompanyResourceCollection($companies);
    }

    /**
     * create a company
     *
     * @param  StoreRequest $request
     * @return CompanyResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', Company::class);

        $company = $this->companyRepository->save($request->all());
        return new CompanyResource($company);
    }

    /**
     * get a company
     *
     * @param Company $company
     * @return CompanyResource
     * @throws AuthorizationException
     */
    public function show(Company $company)
    {
        $this->authorize('show', $company);

        return new CompanyResource($company);
    }

    /**
     * update a company
     *
     * @param  UpdateRequest $request
     * @param  Company $company
     * @return CompanyResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        $company = $this->companyRepository->update($company, $request->all());

        return new CompanyResource($company);
    }

    /**
     * remove a company
     *
     * @param Company $company
     * @return null
     * @throws AuthorizationException
     */
    public function destroy(Company $company)
    {
        $this->authorize('destroy', $company);

        $this->companyRepository->delete($company);

        return response()->json(null, 204);
    }
}
