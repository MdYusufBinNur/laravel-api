@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Your payment has been updated.'])
@endsection

@section('content')
    @include('payment.status-change-notification.body', ['property' => $property, 'payment' => $payment, 'paymentItem' => $paymentItem])
@endsection
