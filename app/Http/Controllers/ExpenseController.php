<?php

namespace App\Http\Controllers;

use App\DbModels\Expense;
use App\Http\Requests\Expense\IndexRequest;
use App\Http\Requests\Expense\StoreRequest;
use App\Http\Requests\Expense\UpdateRequest;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\ExpenseResourceCollection;
use App\Repositories\Contracts\ExpenseRepository;
use http\Env\Response;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    /**
     * @var ExpenseRepository
     */
    protected $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ExpenseResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $expenses = $this->expenseRepository->findBy($request->all());

        return new ExpenseResourceCollection($expenses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ExpenseResource
     */
    public function store(StoreRequest $request)
    {
        $expense = $this->expenseRepository->save($request->all());

        return new ExpenseResource($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param Expense $expense
     * @return ExpenseResource
     */
    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Expense $expense
     * @return ExpenseResource
     */
    public function update(UpdateRequest $request, Expense $expense)
    {
        $expense = $this->expenseRepository->update($expense, $request->all());

        return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Expense $expense
     * @return void
     */
    public function destroy(Expense $expense)
    {
        $this->expenseRepository->delete($expense);

        return response()->json(null, 204);
    }
}
