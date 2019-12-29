@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'You have a invoice - see the attached'])
@endsection

@section('content')
    @include('payment.send-invoice.body', ['property' => $property, 'payment' => $payment, 'paymentItem' => $paymentItem])
@endsection
