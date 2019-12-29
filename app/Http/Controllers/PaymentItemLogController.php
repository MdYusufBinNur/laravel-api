<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentItemLog;
use App\Http\Requests\PaymentItemLog\IndexRequest;
use App\Http\Requests\PaymentItemLog\StoreRequest;
use App\Http\Requests\PaymentItemLog\UpdateRequest;
use App\Http\Resources\PaymentItemLogResource;
use App\Http\Resources\PaymentItemLogResourceCollection;
use App\Repositories\Contracts\PaymentItemLogRepository;

class PaymentItemLogController extends Controller
{
    /**
     * @var PaymentItemLogRepository
     */
    protected $paymentItemLogRepository;

    /**
     * PaymentItemLogController constructor.
     * @param PaymentItemLogRepository $paymentItemLogRepository
     */
    public function __construct(PaymentItemLogRepository $paymentItemLogRepository)
    {
        $this->paymentItemLogRepository = $paymentItemLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentItemLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentItemLogs = $this->paymentItemLogRepository->findBy($request->all());

        return new PaymentItemLogResourceCollection($paymentItemLogs);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentItemLog $paymentItemLog
     * @return PaymentItemLogResource
     */
    public function show(PaymentItemLog $paymentItemLog)
    {
        return new PaymentItemLogResource($paymentItemLog);
    }
}
