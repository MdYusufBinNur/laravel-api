@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('payment.status-change-notification.body', ['contactName' => $contactName, 'property' => $property, 'payment' => $payment, 'paymentItem' => $paymentItem])
@endsection
