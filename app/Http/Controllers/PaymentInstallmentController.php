<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentInstallment;
use App\Http\Requests\PaymentInstallment\IndexRequest;
use App\Http\Requests\PaymentInstallment\StoreRequest;
use App\Http\Requests\PaymentInstallment\UpdateRequest;
use App\Http\Resources\PaymentInstallmentResource;
use App\Http\Resources\PaymentInstallmentResourceCollection;
use App\Repositories\Contracts\PaymentInstallmentRepository;

class PaymentInstallmentController extends Controller
{
    /**
     * @var PaymentInstallmentRepository
     */
    protected $paymentInstallmentRepository;

    /**
     * PaymentInstallmentController constructor.
     * @param PaymentInstallmentRepository $paymentInstallmentRepository
     */
    public function __construct(PaymentInstallmentRepository $paymentInstallmentRepository)
    {
        $this->paymentInstallmentRepository = $paymentInstallmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentInstallmentResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentInstallments = $this->paymentInstallmentRepository->findBy($request->all());

        return new PaymentInstallmentResourceCollection($paymentInstallments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentInstallmentResource
     */
    public function store(StoreRequest $request)
    {
        $paymentInstallment = $this->paymentInstallmentRepository->save($request->all());

        return new PaymentInstallmentResource($paymentInstallment);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentInstallment $paymentInstallment
     * @return PaymentInstallmentResource
     */
    public function show(PaymentInstallment $paymentInstallment)
    {
        return new PaymentInstallmentResource($paymentInstallment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentInstallment $paymentInstallment
     * @return PaymentInstallmentResource
     */
    public function update(UpdateRequest $request, PaymentInstallment $paymentInstallment)
    {
        $paymentInstallment = $this->paymentInstallmentRepository->update($paymentInstallment, $request->all());

        return new PaymentInstallmentResource($paymentInstallment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentInstallment $paymentInstallment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentInstallment $paymentInstallment)
    {
        $this->paymentInstallmentRepository->delete($paymentInstallment);

        return response()->json(null, 204);
    }
}
