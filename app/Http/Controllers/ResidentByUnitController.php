<?php

namespace App\Http\Controllers;

use App\DbModels\Resident;
use App\Http\Requests\Resident\IndexRequest;
use App\Http\Requests\Resident\ResidentByUnitRequest;
use App\Http\Resources\ResidentByUnitResourceCollection;
use App\Repositories\Contracts\ResidentRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(ResidentByUnitRequest $request)
    {
        $this->authorize('residentByUnitController', [Resident::class, $request->input('propertyId')]);

        $residents = $this->residentRepository->getResidentsByUnits($request->all());
        return new ResidentByUnitResourceCollection(collect($residents));
    }
}
