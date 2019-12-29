<?php

namespace App\Http\Controllers;

use App\DbModels\Payment;
use App\Http\Requests\Payment\IndexRequest;
use App\Http\Requests\Payment\StoreRequest;
use App\Http\Requests\Payment\UpdateRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\PaymentResourceCollection;
use App\Repositories\Contracts\PaymentRepository;

class PaymentController extends Controller
{
    /**
     * @var PaymentRepository
     */
    protected $paymentRepository;

    /**
     * PaymentController constructor.
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $payments = $this->paymentRepository->findBy($request->all());

        return new PaymentResourceCollection($payments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentResource
     */
    public function store(StoreRequest $request)
    {
        $payment = $this->paymentRepository->savePayment($request->all());

        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param Payment $payment
     * @return PaymentResource
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Payment $payment
     * @return PaymentResource
     */
    public function update(UpdateRequest $request, Payment $payment)
    {
        $payment = $this->paymentRepository->updatePayment($payment, $request->all());

        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Payment $payment
     * @return PaymentResource
     */
    public function destroy(Payment $payment)
    {
        $this->paymentRepository->delete($payment);

        return response()->json(null, 204);
    }
}
