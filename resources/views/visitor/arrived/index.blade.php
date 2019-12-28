@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'New visitor has arrived in your house'])
@endsection

@section('content')
    @include('visitor.arrived.body', ['visitor' => $visitor])
@endsection
