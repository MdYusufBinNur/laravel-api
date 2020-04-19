@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('payment.send-invoice.body', ['contactName'=> $contactName, 'property' => $property, 'payment' => $payment, 'paymentItem' => $paymentItem])
@endsection
