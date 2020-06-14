<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentItemTransaction;
use App\Http\Requests\PaymentItemTransaction\IndexRequest;
use App\Http\Requests\PaymentItemTransaction\StoreRequest;
use App\Http\Requests\PaymentItemTransaction\UpdateRequest;
use App\Http\Resources\PaymentItemTransactionResource;
use App\Http\Resources\PaymentItemTransactionResourceCollection;
use App\Repositories\Contracts\PaymentItemTransactionRepository;

class PaymentItemTransactionController extends Controller
{
    /**
     * @var PaymentItemTransactionRepository
     */
    protected $paymentItemTransactionRepository;

    /**
     * PaymentItemTransactionController constructor.
     * @param PaymentItemTransactionRepository $paymentItemTransactionRepository
     */
    public function __construct(PaymentItemTransactionRepository $paymentItemTransactionRepository)
    {
        $this->paymentItemTransactionRepository = $paymentItemTransactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentItemTransactionResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentItemTransactions = $this->paymentItemTransactionRepository->findBy($request->all());

        return new PaymentItemTransactionResourceCollection($paymentItemTransactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentItemTransactionResource
     */
    public function store(StoreRequest $request)
    {
        $paymentItemTransaction = $this->paymentItemTransactionRepository->save($request->all());

        return new PaymentItemTransactionResource($paymentItemTransaction);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentItemTransaction $paymentItemTransaction
     * @return PaymentItemTransactionResource
     */
    public function show(PaymentItemTransaction $paymentItemTransaction)
    {
        return new PaymentItemTransactionResource($paymentItemTransaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentItemTransaction $paymentItemTransaction
     * @return PaymentItemTransactionResource
     */
    public function update(UpdateRequest $request, PaymentItemTransaction $paymentItemTransaction)
    {
        $paymentItemTransaction = $this->paymentItemTransactionRepository->update($paymentItemTransaction, $request->all());

        return new PaymentItemTransactionResource($paymentItemTransaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentItemTransaction $paymentItemTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentItemTransaction $paymentItemTransaction)
    {
        $this->paymentItemTransactionRepository->delete($paymentItemTransaction);

        return response()->json(null, 204);
    }
}
