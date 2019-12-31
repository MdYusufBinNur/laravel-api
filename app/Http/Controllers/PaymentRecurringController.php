<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentRecurring;
use App\Http\Requests\PaymentRecurring\IndexRequest;
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
     * Display the specified resource.
     *
     * @param PaymentRecurring $paymentRecur
     * @return PaymentRecurringResource
     */
    public function show(PaymentRecurring $paymentRecur)
    {
        return new PaymentRecurringResource($paymentRecur);
    }
}
