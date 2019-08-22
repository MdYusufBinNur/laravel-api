<?php

namespace App\Http\Controllers;

use App\Http\Requests\Resident\IndexRequest;
use App\Http\Requests\Resident\ResidentByUnitRequest;
use App\Http\Resources\ResidentByUnitResourceCollection;
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
     * @return ResidentByUnitResourceCollection
     */
    public function index(ResidentByUnitRequest $request)
    {
        $residents = $this->residentRepository->getResidentsByUnits($request->all());
        return new ResidentByUnitResourceCollection(collect($residents));
    }
}
