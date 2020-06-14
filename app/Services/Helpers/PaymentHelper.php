<?php


namespace App\Services\Helpers;

use App\DbModels\PaymentItem;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentHelper
{
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

            $url = 'https://0xhq44kkal.execute-api.us-east-1.amazonaws.com/dev/generate-payment';
            $response = $client->request('post', $url, ['json' => $paymentData]);
            return json_decode($response->getBody()->getContents());

        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());
        }
    }
}
