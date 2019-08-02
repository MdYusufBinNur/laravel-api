<?php

namespace App\Http\Controllers;

use App\DbModels\Resident;
use App\Http\Requests\Resident\IndexRequest;
use App\Http\Requests\Resident\StoreRequest;
use App\Http\Requests\Resident\UpdateRequest;
use App\Http\Resources\ResidentByUnitResourceCollection;
use App\Http\Resources\ResidentResource;
use App\Http\Resources\ResidentResourceCollection;
use App\Repositories\Contracts\ResidentRepository;

class ResidentByUnitController extends Controller
{
    /**
     * @var ResidentRepository
     */
    protected $residentRepository;

    /**
     * ResidentController constructor.
     * @param ResidentRepository $residentRepository
     */
    public function __construct(ResidentRepository $residentRepository)
    {
        $this->residentRepository = $residentRepository;
    }

    /**
     * Display a listing of the  Resident resource.
     *
     * @param IndexRequest $request
     * @return ResidentResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $residents = $this->residentRepository->getResidentsByUnits($request->all());
        return new ResidentByUnitResourceCollection(collect($residents));
    }
}
