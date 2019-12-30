<?php

namespace App\Console\Commands;

use App\DbModels\Payment;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\PaymentPublishLogRepository;
use App\Repositories\Contracts\PaymentRecurringRepository;
use App\Repositories\Contracts\PaymentRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PublishPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pms:publish-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish payment to payment item';

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * @var PaymentItemRepository
     */
    private $paymentItemRepository;

    /**
     * @var PaymentRecurringRepository
     */
    private $paymentRecurringRepository;

    /**
     * Create a new command instance.
     *
     * @param PaymentRepository $paymentRepository
     * @param PaymentItemRepository $paymentItemRepository
     * @param PaymentRecurringRepository $paymentRecurringRepository
     * @return void
     */
    public function __construct(PaymentRepository $paymentRepository, PaymentItemRepository $paymentItemRepository, PaymentRecurringRepository $paymentRecurringRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->paymentItemRepository = $paymentItemRepository;
        $this->paymentRecurringRepository = $paymentRecurringRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $totalOneTimePaymentsPublished = $this->publishOneTimePayments();
        $totalRecurringPaymentsPublished = $this->publishRecurringPayments();

        echo 'Total One Time Payments Published: ' . $totalOneTimePaymentsPublished;
        echo '\nTotal Recurring Payments Published: ' . $totalRecurringPaymentsPublished;
    }

    private function publishOneTimePayments()
    {
        $oneTimePayments = $this->paymentRepository->getModel()
            ->whereDate('activationDate', '<=', Carbon::today())
            ->where('status', Payment::STATUS_NOT_PUBLISHED)
            ->where('isRecurring', 0)
            ->get();

        $totalOneTimePaymentsPublished = 0;
        foreach ($oneTimePayments as $payment) {
            $this->paymentItemRepository->publishPayment($payment);
            $totalOneTimePaymentsPublished++;
        }

        return $totalOneTimePaymentsPublished;
    }

    private function publishRecurringPayments()
    {
        $totalRecurringPaymentsPublished = 0;
        $this->paymentRecurringRepository->getModel()
            ->whereDate('expireDate', '>', Carbon::today())
            ->chunk(100, function ($recurringPayments) use (&$totalRecurringPaymentsPublished) {
                foreach ($recurringPayments as $recurringPayment) {
                    $payment = $recurringPayment->payment;

                    $this->paymentItemRepository->publishPayment($payment);

                    $totalRecurringPaymentsPublished++;
                }
            });

        return $totalRecurringPaymentsPublished;
    }
}
