<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentRecurring;
use App\Http\Requests\PaymentRecurring\IndexRequest;
use App\Http\Resources\PaymentRecurringResource;
use App\Http\Resources\PaymentRecurringResourceCollection;
use App\Repositories\Contracts\PaymentRecurringRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PaymentRecurringController extends Controller
{
    /**
     * @var PaymentRecurringRepository
     */
    protected $paymentRecurringRepository;

    /**
     * PaymentRecurringController constructor.
     * @param PaymentRecurringRepository $paymentRecurRepository
     */
    public function __construct(PaymentRecurringRepository $paymentRecurRepository)
    {
        $this->paymentRecurringRepository = $paymentRecurRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentRecurringResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PaymentRecurring::class, $request->get('propertyId')]);

        $paymentRecurs = $this->paymentRecurringRepository->findBy($request->all());

        return new PaymentRecurringResourceCollection($paymentRecurs);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentRecurring $paymentRecurring
     * @return PaymentRecurringResource
     * @throws AuthorizationException
     */
    public function show(PaymentRecurring $paymentRecurring)
    {
        $this->authorize('show', $paymentRecurring);

        return new PaymentRecurringResource($paymentRecurring);
    }
}
