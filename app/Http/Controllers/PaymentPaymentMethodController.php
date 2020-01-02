<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentPaymentMethod;
use App\Http\Requests\PaymentPaymentMethod\IndexRequest;
use App\Http\Requests\PaymentPaymentMethod\StoreRequest;
use App\Http\Requests\PaymentPaymentMethod\UpdateRequest;
use App\Http\Resources\PaymentPaymentMethodResource;
use App\Http\Resources\PaymentPaymentMethodResourceCollection;
use App\Repositories\Contracts\PaymentPaymentMethodRepository;
use Illuminate\Http\Request;

class PaymentPaymentMethodController extends Controller
{
    /**
     * @var PaymentPaymentMethodRepository
     */
    protected $paymentPaymentMethodRepository;

    /**
     * PaymentPaymentMethodController constructor.
     * @param PaymentPaymentMethodRepository $paymentPaymentMethodRepository
     */
    public function __construct(PaymentPaymentMethodRepository $paymentPaymentMethodRepository)
    {
        $this->paymentPaymentMethodRepository = $paymentPaymentMethodRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentPaymentMethodResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentPaymentMethods = $this->paymentPaymentMethodRepository->findBy($request->all());

        return new PaymentPaymentMethodResourceCollection($paymentPaymentMethods);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentPaymentMethod $paymentPaymentMethod
     * @return PaymentPaymentMethodResource
     */
    public function show(PaymentPaymentMethod $paymentPaymentMethod)
    {
        return new PaymentPaymentMethodResource($paymentPaymentMethod);
    }
}
