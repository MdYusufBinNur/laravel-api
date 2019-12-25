<?php

namespace App\Http\Controllers;

use App\DbModels\Income;
use App\Http\Requests\Income\IndexRequest;
use App\Http\Requests\Income\StoreRequest;
use App\Http\Requests\Income\UpdateRequest;
use App\Http\Resources\IncomeResource;
use App\Http\Resources\IncomeResourceCollection;
use App\Repositories\Contracts\IncomeRepository;

class IncomeController extends Controller
{
    /**
     * @var IncomeRepository
     */
    protected $incomeRepository;

    /**
     * IncomeController constructor.
     * @param IncomeRepository $incomeRepository
     */
    public function __construct(IncomeRepository $incomeRepository)
    {
        $this->incomeRepository = $incomeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return IncomeResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $incomes = $this->incomeRepository->findBy($request->all());

        return new IncomeResourceCollection($incomes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return IncomeResource
     */
    public function store(StoreRequest $request)
    {
        $income = $this->incomeRepository->save($request->all());

        return new IncomeResource($income);
    }

    /**
     * Display the specified resource.
     *
     * @param Income $income
     * @return IncomeResource
     */
    public function show(Income $income)
    {
        return new IncomeResource($income);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Income $income
     * @return IncomeResource
     */
    public function update(UpdateRequest $request, Income $income)
    {
        $income = $this->incomeRepository->update($income, $request->all());

        return new IncomeResource($income);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Income $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $this->incomeRepository->delete($income);

        return response()->json(null, 204);
    }
}
