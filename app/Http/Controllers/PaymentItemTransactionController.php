<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentItemTransaction;
use App\Http\Requests\PaymentItemTransaction\IndexRequest;
use App\Http\Requests\PaymentItemTransaction\NotifyRequest;
use App\Http\Requests\PaymentItemTransaction\StoreRequest;
use App\Http\Requests\PaymentItemTransaction\UpdateRequest;
use App\Http\Resources\PaymentItemTransactionResource;
use App\Http\Resources\PaymentItemTransactionResourceCollection;
use App\Repositories\Contracts\PaymentItemTransactionRepository;
use App\Services\Helpers\PaymentHelper;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list' , [PaymentItemTransaction::class, $request->get('propertyId')]);

        $paymentItemTransactions = $this->paymentItemTransactionRepository->findBy($request->all());

        return new PaymentItemTransactionResourceCollection($paymentItemTransactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentItemTransactionResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store' , [PaymentItemTransaction::class, $request->get('paymentItemId')]);

        $paymentItemTransaction = $this->paymentItemTransactionRepository->generateTransaction($request->all());

        return new PaymentItemTransactionResource($paymentItemTransaction);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentItemTransaction $paymentItemTransaction
     * @return PaymentItemTransactionResource
     * @throws AuthorizationException
     */
    public function show(PaymentItemTransaction $paymentItemTransaction)
    {
        $this->authorize('show', $paymentItemTransaction);

        return new PaymentItemTransactionResource($paymentItemTransaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentItemTransaction $paymentItemTransaction
     * @return PaymentItemTransactionResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PaymentItemTransaction $paymentItemTransaction)
    {
        $this->authorize('update', $paymentItemTransaction);

        $paymentItemTransaction = $this->paymentItemTransactionRepository->update($paymentItemTransaction, $request->all());

        return new PaymentItemTransactionResource($paymentItemTransaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentItemTransaction $paymentItemTransaction
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(PaymentItemTransaction $paymentItemTransaction)
    {
        $this->authorize('destroy', $paymentItemTransaction);

        $this->paymentItemTransactionRepository->delete($paymentItemTransaction);

        return response()->json(null, 204);
    }

    /**
     * notify a transaction
     *
     * @param NotifyRequest $request
     * @return PaymentItemTransactionResource
     */
    public function notify(NotifyRequest $request)
    {
        $paymentItemTransaction = $this->paymentItemTransactionRepository->findOneBy(['providerName' => $request->get('providerName'), 'providerId' => $request->get('providerId')]);

        if (!$paymentItemTransaction instanceof PaymentItemTransaction) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        $this->paymentItemTransactionRepository->updateTransaction($paymentItemTransaction, $request->get('providerId'));

        return new PaymentItemTransactionResource($paymentItemTransaction);
    }

}
