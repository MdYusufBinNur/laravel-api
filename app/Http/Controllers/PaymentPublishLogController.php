<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentPublishLog;
use App\Http\Requests\PaymentPublishLog\IndexRequest;
use App\Http\Resources\PaymentPublishLogResource;
use App\Http\Resources\PaymentPublishLogResourceCollection;
use App\Repositories\Contracts\PaymentPublishLogRepository;

class PaymentPublishLogController extends Controller
{
    /**
     * @var PaymentPublishLogRepository
     */
    protected $paymentPublishLogRepository;

    /**
     * PaymentPublishLogController constructor.
     * @param PaymentPublishLogRepository $paymentPublishLogRepository
     */
    public function __construct(PaymentPublishLogRepository $paymentPublishLogRepository)
    {
        $this->paymentPublishLogRepository = $paymentPublishLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentPublishLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentPublishLogs = $this->paymentPublishLogRepository->findBy($request->all());

        return new PaymentPublishLogResourceCollection($paymentPublishLogs);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentPublishLog $paymentPublishLog
     * @return PaymentPublishLogResource
     */
    public function show(PaymentPublishLog $paymentPublishLog)
    {
        return new PaymentPublishLogResource($paymentPublishLog);
    }
}
