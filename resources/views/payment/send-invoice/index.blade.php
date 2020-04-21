@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('payment.send-invoice.body', ['contactName'=> $contactName, 'property' => $property,   'paymentDetailsPage' => $paymentDetailsPage, 'paymentType' => $paymentType, 'payment' => $payment, 'paymentItem' => $paymentItem])
@endsection
