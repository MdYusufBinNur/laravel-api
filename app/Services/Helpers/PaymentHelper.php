<?php


namespace App\Services\Helpers;

use App\DbModels\PaymentItem;
use App\DbModels\PaymentItemTransaction;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PaymentHelper
{
    /**
     * generate payment link
     *
     * @param PaymentItem $paymentItem
     * @return array
     */
    public static function generatePaymentLink(PaymentItem $paymentItem)
    {
        $currentUser = Auth::user();
        $payment = $paymentItem->payment;

        $paymentData = [
            'orderId' => $paymentItem->id,
            'refId' => $paymentItem->propertyId . '-' .  $paymentItem->id . '-' . Str::random(4),
            'appName' => config('app.brand_site'),
            'cartInfo' => 'Payment by ' . $currentUser->name . '(' . $currentUser->id . ')',
            'customerName' => $currentUser->name,
            'customerEmail' => $currentUser->email,
            'customerAddress' => 'Dhaka',
            'customerPhone' => $currentUser->phone,
            'productDescription' => 'Payment of amount : ' . $payment->amount,
            'amount' => $payment->amount,
            'currency' => 'BDT',
            'options' => 'cz1yZWZvcm1lZHRlY2gub3JnLGk9MTkyLjE2OC41LjI=',
            'callbackURL' => config('app.payment_callback_url')
        ];

        $client = new Client([
            'headers' => [
                'Token' => config('app.ms_sms_api_token'),
                'Content-Type'  => 'application/json',
                'Accept'  => 'application/json'
            ]
        ]);

        try {

            $url = config('app.payment_ms_api') . '/generate-payment';
            $response = $client->request('post', $url, ['json' => $paymentData]);
            $paymentUrlObject = json_decode($response->getBody()->getContents());

            return (array) $paymentUrlObject;

        } catch (RequestException $e) {
            throw ValidationException::withMessages([
                'data' => $e->getResponse()->getBody()->getContents()
            ]);
        }
    }

    /**
     * get payment status
     *
     * @param string $token
     * @return array
     */
    public static function getPaymentStatus(string $token)
    {
        $client = new Client([
            'headers' => [
                'Token' => config('app.ms_sms_api_token'),
                'Content-Type'  => 'application/json',
                'Accept'  => 'application/json'
            ]
        ]);

        try {

            $url = config('app.payment_ms_api') . '/check-payment';
            $response = $client->request('post', $url, ['json' => ['id' => $token]]);
            $paymentItemStatusObject = json_decode($response->getBody()->getContents());
            $paymentStatusDetails = (array) $paymentItemStatusObject;

            $status = PaymentItemTransaction::STATUS_FAILED;
            if (isset($paymentStatusDetails['statusCode'])) {
                switch ((int) $paymentStatusDetails['statusCode']) {
                    case 1000:
                        $status = PaymentItemTransaction::STATUS_SUCCESS;
                        break;
                    case 1001:
                        $status = PaymentItemTransaction::STATUS_REJECTED;
                        break;
                   default:
                        $status = PaymentItemTransaction::STATUS_FAILED;
                        break;
                }
            }

            return ['status' => $status, 'rawData' => $paymentStatusDetails];

        } catch (RequestException $e) {
            throw ValidationException::withMessages([
                'data' => $e->getResponse()->getBody()->getContents()
            ]);
        }
    }
}