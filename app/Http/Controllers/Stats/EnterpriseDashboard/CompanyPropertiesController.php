<?php

namespace App\Http\Controllers\Stats\EnterpriseDashboard;

use App\DbModels\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stats\EnterpriseDashboard\CompanyProperties\IndexRequest;
use App\Http\Resources\Stats\EnterpriseDashboard\CompanyPropertiesResource;
use App\Repositories\Contracts\CompanyRepository;

class CompanyPropertiesController extends Controller
{
    /**
     * @var Company
     */
    private $companyRepository;

    /**
     * CompanyPropertiesController constructor.
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
     * @return CompanyPropertiesResource
     */
    public function index(IndexRequest $request)
    {
        $company = $this->companyRepository->findOne($request->companyId);
        $properties = $company->properties;
        $data = [
            'totalActiveUsers' => 0,
            'totalStaffs' => 0,
            'totalEnterpriseUsers' => $company->enterpriseUsers()->count(),
            'totalUnits' => 0,
            'totalTowers' => 0,
        ];

        foreach ($properties as $property) {
            $data['totalActiveUsers'] += $property->users()->count();
            $data['totalTowers'] += $property->towers()->count();
            $data['totalUnits'] += $property->units()->count();
            $data['totalStaffs'] += $property->staffUsers()->count();
        }


        return new CompanyPropertiesResource($data);
    }
}
