@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'A new Package just arrived for you. Please collect it from Front Desk'])
@endsection

@section('content')
    @include('package.arrived.body', ['package' => $package])
@endsection
