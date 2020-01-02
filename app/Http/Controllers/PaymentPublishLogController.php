<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentPublishLog;
use App\Http\Requests\PaymentPublishLog\IndexRequest;
use App\Http\Resources\PaymentPublishLogResource;
use App\Http\Resources\PaymentPublishLogResourceCollection;
use App\Repositories\Contracts\PaymentPublishLogRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PaymentPublishLog::class]);

        $paymentPublishLogs = $this->paymentPublishLogRepository->findBy($request->all());

        return new PaymentPublishLogResourceCollection($paymentPublishLogs);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentPublishLog $paymentPublishLog
     * @return PaymentPublishLogResource
     * @throws AuthorizationException
     */
    public function show(PaymentPublishLog $paymentPublishLog)
    {
        $this->authorize('show', $paymentPublishLog);

        return new PaymentPublishLogResource($paymentPublishLog);
    }
}
