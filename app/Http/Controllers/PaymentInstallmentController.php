<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentInstallment;
use App\Http\Requests\PaymentInstallment\IndexRequest;
use App\Http\Requests\PaymentInstallment\StoreRequest;
use App\Http\Requests\PaymentInstallment\UpdateRequest;
use App\Http\Resources\PaymentInstallmentResource;
use App\Http\Resources\PaymentInstallmentResourceCollection;
use App\Repositories\Contracts\PaymentInstallmentRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PaymentInstallment::class, $request->input('propertyId')]);

        $paymentInstallments = $this->paymentInstallmentRepository->findBy($request->all());

        return new PaymentInstallmentResourceCollection($paymentInstallments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentInstallmentResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PaymentInstallment::class, $request->input('propertyId')]);

        $paymentInstallment = $this->paymentInstallmentRepository->save($request->all());

        return new PaymentInstallmentResource($paymentInstallment);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentInstallment $paymentInstallment
     * @return PaymentInstallmentResource
     * @throws AuthorizationException
     */
    public function show(PaymentInstallment $paymentInstallment)
    {
        $this->authorize('show', $paymentInstallment);

        return new PaymentInstallmentResource($paymentInstallment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentInstallment $paymentInstallment
     * @return PaymentInstallmentResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PaymentInstallment $paymentInstallment)
    {
        $this->authorize('update', $paymentInstallment);

        $paymentInstallment = $this->paymentInstallmentRepository->update($paymentInstallment, $request->all());

        return new PaymentInstallmentResource($paymentInstallment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentInstallment $paymentInstallment
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(PaymentInstallment $paymentInstallment)
    {
        $this->authorize('destroy', $paymentInstallment);

        $this->paymentInstallmentRepository->delete($paymentInstallment);

        return response()->json(null, 204);
    }
}
