<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentRecurring;
use App\Http\Requests\PaymentRecurring\IndexRequest;
use App\Http\Requests\PaymentRecurring\StoreRequest;
use App\Http\Requests\PaymentRecurring\UpdateRequest;
use App\Http\Resources\PaymentRecurringResource;
use App\Http\Resources\PaymentRecurringResourceCollection;
use App\Repositories\Contracts\PaymentRecurringRepository;

class PaymentRecurringController extends Controller
{
    /**
     * @var PaymentRecurringRepository
     */
    protected $paymentRecurRepository;

    /**
     * PaymentRecurringController constructor.
     * @param PaymentRecurringRepository $paymentRecurRepository
     */
    public function __construct(PaymentRecurringRepository $paymentRecurRepository)
    {
        $this->paymentRecurRepository = $paymentRecurRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentRecurringResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentRecurs = $this->paymentRecurRepository->findBy($request->all());

        return new PaymentRecurringResourceCollection($paymentRecurs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentRecurringResource
     */
    public function store(StoreRequest $request)
    {
        $paymentRecur = $this->paymentRecurRepository->save($request->all());

        return new PaymentRecurringResource($paymentRecur);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentRecurring $paymentRecur
     * @return PaymentRecurringResource
     */
    public function show(PaymentRecurring $paymentRecur)
    {
        return new PaymentRecurringResource($paymentRecur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentRecurring $paymentRecur
     * @return PaymentRecurringResource
     */
    public function update(UpdateRequest $request, PaymentRecurring $paymentRecur)
    {
        $paymentRecur = $this->paymentRecurRepository->update($paymentRecur, $request->all());

        return new PaymentRecurringResource($paymentRecur);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentRecurring $paymentRecur
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentRecurring $paymentRecur)
    {
        $this->paymentRecurRepository->delete($paymentRecur);

        return response()->json(null, 204);
    }
}
