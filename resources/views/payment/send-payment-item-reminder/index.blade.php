@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('payment.send-payment-item-reminder.body',['reminder' => $reminder, 'property' => $property, 'user' => $user, 'paymentDetailsPage' => $paymentDetailsPage, 'details' => $details, 'payment' => $payment, 'paymentType' => $paymentType])
@endsection
